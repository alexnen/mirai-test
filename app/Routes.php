<?php

namespace App;

use App\Services\Interfaces\RoutesInterface;
use MainController;

class Routes implements RoutesInterface
{
    public function getRoutes(): array
    {
        return [
            '/' => [MainController::class, 'index'],
        ];
    }
}