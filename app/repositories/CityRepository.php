<?php

namespace App\Repositories;

use App\BaseClasses\BaseRepository;
use App\Models\City;
use App\Services\Interfaces\ModelInterface;

class CityRepository extends BaseRepository
{
    protected ModelInterface $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new City();
    }
}