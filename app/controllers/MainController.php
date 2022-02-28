<?php

namespace App\Controllers;

use App\Repositories\CityRepository;
use App\Services\App;

class MainController
{
    public function getByIdAndTz(array $params)
    {
        return App::get('response')->sendResponse($params);
    }

    public function getByTimeAndTz(array $params)
    {
        return App::get('response')->sendResponse($params);
    }

    public function reloadData(array $params)
    {
        return App::get('response')->sendResponse($params);
    }
}