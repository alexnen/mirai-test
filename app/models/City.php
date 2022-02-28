<?php

namespace App\Models;

use App\AbstractClasses\BaseModel;

class City extends BaseModel
{
    public array $fields = [
        'id' => 'string',
        'country_iso3' => 'string',
        'name' => 'string',
        'latitude' => 'number',
        'longitude' => 'number',
    ];

    protected string $table = 'city';
}