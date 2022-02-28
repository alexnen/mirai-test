<?php

namespace App\Services\Interfaces;

interface DB
{
    public function runQuery(string $query);
}