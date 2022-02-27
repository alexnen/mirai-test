<?php

namespace App\Services;

use App\Services\Interfaces\RouterInterface;
use Closure;
use Exception;
use App\Helpers\Helper;

class Router implements RouterInterface
{
    private string $urn;
    private string $method;
    private array $routes;

    private function fillRequestData(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->urn = str_replace(
            $_SERVER['SERVER_NAME'],
            '',
            parse_url($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])['path']
        );
    }

    private function fillAvailableRoutes(): void
    {
        $routesFiles = Helper::getConfig('router_config.router_classes');

        foreach ($routesFiles as $routesFile) {
            $this->routes[] = (new $routesFile)->getRoutes();
        }
    }

    public function exec(): self
    {
        $this->fillRequestData();
        $this->fillAvailableRoutes();

        return $this;
    }

    public function getNextFunction(array $params): Closure
    {
        foreach ($this->routes as $routeFile) {
            if (isset($routeFile[$this->urn])) {
                $functionName = $routeFile[$this->urn][1];

                return fn() => (new $routeFile[$this->urn][0])->$functionName($params);
            }
        }

        throw new Exception('Route not found', 404);
    }

    public function getParams(): array
    {
        return $_REQUEST;
    }
}