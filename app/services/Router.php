<?php

namespace App\Services;

use App\Services\Interfaces\RouterInterface;
use Helper;

class Router implements RouterInterface
{
    private string $urn;
    private string $method;
    private array $routes;

    private function fillRequestData(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->urn = $_SERVER['REQUEST_URI'];
    }

    private function fillAvailableRoutes(): void
    {
        $routesFiles = Helper::getConfig('router_config.router_classes');

        foreach ($routesFiles as $routesFile) {
            $this->routes[] = (new $routesFile)->getRoutes();
        }
    }

    public function exec(): void
    {
        $this->fillRequestData();
        $this->fillAvailableRoutes();
    }

    public function run()
    {

    }
}