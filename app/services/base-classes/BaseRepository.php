<?php

namespace App\BaseClasses;

use App\Services\App;
use App\Services\Interfaces\DB;
use App\Services\Interfaces\ModelInterface;
use App\Services\Interfaces\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    protected ModelInterface $model;

    private DB $dbConnector;

    public function __construct()
    {
        $this->dbConnector = App::get('db');
    }

    public function get(): array
    {
        $data = $this->dbConnector->runQuery('select * from "' . $this->model->getTable() . '"');

        $result = [];

        foreach ($data as $item) {
            $objectItem = new $this->model;

            $fields = $this->model->getFields();

            foreach ($item as $key => $fieldVal) {
                foreach ($fields as $fieldKey => $type) {
                    if ($key == $fieldKey) {
                        $objectItem->$key = $fieldVal;
                    }
                }
            }
            $result[] = $objectItem;
        }

        return $result;
    }

    public function first(array $conditions = null): ModelInterface
    {
        $query = 'select * from "' . $this->model->getTable() . '"';

        if ($conditions) {
            $query .= $this->getConditionString($conditions);
        }

        $query .= ' limit 1';

        $data = $this->dbConnector->runQuery($query);

        $objectItem = new $this->model;

        $fields = $this->model->getFields();

        foreach ($data[0] as $key => $fieldVal) {
            foreach ($fields as $fieldKey => $type) {
                if ($key == $fieldKey) {
                    $objectItem->$key = $fieldVal;
                }
            }
        }

        return $objectItem;
    }

    public function update(array $dataToUpdate, array $conditions = null)
    {
        $dataToUpdateQueryString = '';
        foreach ($dataToUpdate as $field => $val) {

            if ($this->model->getFields()[$field] === 'string') {
                $val = "'" . $val . "'";
            }

            $dataToUpdateQueryString .= ' ' . $field . ' = ' . $val . ',';
        }

        $dataToUpdateQueryString = substr($dataToUpdateQueryString, 0, -1);

        $query = 'update "' . $this->model->getTable() . '" set ' . $dataToUpdateQueryString;

        if ($conditions) {
            $query .= $this->getConditionString($conditions);
        }

        $this->dbConnector->runQuery($query);
    }

    public function delete(array $conditions)
    {
        $conditionsQueryString = '';

        $query = 'delete from "' . $this->model->getTable() . '" where ';

        foreach ($conditions as $field => $val) {
            if ($this->model->getFields()[$field] === 'string') {
                $val = "'" . $val . "'";
            }

            $conditionsQueryString .= ' ' . $field . ' = ' . $val . ' and';
        }

        $conditionsQueryString = substr($conditionsQueryString, 0, -3);

        $query .= $conditionsQueryString;

        $this->dbConnector->runQuery($query);
    }

    private function getConditionString(array $conditions): string
    {
        $conditionsQueryString = '';

        $query = '';

        foreach ($conditions as $field => $val) {
            if ($this->model->getFields()[$field] === 'string') {
                $val = "'" . $val . "'";
            }

            $conditionsQueryString .= ' ' . $field . ' = ' . $val . ' and';
        }

        $conditionsQueryString = substr($conditionsQueryString, 0, -3);

        $query .= ' where ' . $conditionsQueryString;

        return $query;
    }
}