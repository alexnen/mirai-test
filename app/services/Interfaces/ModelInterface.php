<?php

namespace App\Services\Interfaces;

interface ModelInterface
{
    public function getTable(): string;

    public function getFields(): array;
}