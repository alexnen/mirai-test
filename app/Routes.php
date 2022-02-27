<?php

namespace App;

use App\Controllers\MainController;
use App\Services\Interfaces\RoutesInterface;

class Routes implements RoutesInterface
{
    public function getRoutes(): array
    {
        return [
            '/' => [MainController::class, 'getByIdAndTz'],
            '/test' => [MainController::class, 'getByTimeAndTz'],
            '/reload' => [MainController::class, 'reloadData'],
        ];
    }
}