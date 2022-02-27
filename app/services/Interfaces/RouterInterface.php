<?php

namespace App\Services\Interfaces;

use Closure;

interface RouterInterface
{
    public function exec(): self;

    public function getNextFunction(array $params): Closure;

    public function getParams(): array;
}