<?php

namespace App\Controllers;

use App\Repositories\CityRepository;
use App\Services\App;
use Exception;

class MainController
{
    public function getByIdAndTz(array $params)
    {
        $cityRepository = new CityRepository();

        $city = $cityRepository->get();

        if(!$city) {
            throw new Exception('City not found', 404);
        }

        return App::get('response')->sendResponse($city);
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