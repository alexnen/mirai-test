<?php

namespace App\Services\Interfaces;

interface RouterInterface
{
    public function exec(): void;

    public function run();
}