<?php

namespace App\Services\Interfaces;

interface RepositoryInterface
{
    public function get(): array;

    public function first(): ModelInterface;

    public function update(array $dataToUpdate, array $conditions);

    public function delete(array $conditions);

}