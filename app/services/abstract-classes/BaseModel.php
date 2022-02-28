<?php

namespace App\AbstractClasses;

use App\Services\Interfaces\ModelInterface;

abstract class BaseModel implements ModelInterface
{
    protected string $table;

    public array $fields;

    protected string $repository;

    public function getTable(): string {
        return $this->table;
    }

    public function getFields(): array {
        return $this->fields;
    }
}