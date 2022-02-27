<?php

namespace App\Services;

use App\Services\Interfaces\RouterInterface;
use Exception;

class App
{
    private static array $appBinds = [];

    private static array $appConfigs = [];

    public static function setBind(string $stringBind, string $realizingClass): void
    {
        self::$appBinds[$stringBind] = $realizingClass;
    }

    private static function updateConfigs(): void
    {
        $configDir = __DIR__ . '/../../config';

        $configs = scandir($configDir);

        foreach ($configs as $configFile) {
            if ($configFile != '.' && $configFile != '..') {
                $configFileName = explode('.', $configFile)[0];
                self::$appConfigs[$configFileName] = include $configDir . DIRECTORY_SEPARATOR . $configFile;
            }
        }
    }

    private static function updateBinds(): void
    {
        foreach (self::$appConfigs['app'] as $string => $binds) {
            self::setBind($string, $binds);
        }
    }

    public static function get(string $bind)
    {
        if (isset(self::$appBinds[$bind])) {
            return new self::$appBinds[$bind];
        } else {
            throw new Exception('Bind ' . $bind . ' not found');
        }
    }

    public static function getConfig(): array
    {
        return self::$appConfigs;
    }

    public static function load(): void
    {
        self::updateConfigs();
        self::updateBinds();
    }

    public static function start(RouterInterface $router)
    {
        $params = $router->getParams();

        $methodToStart = $router->getNextFunction($params);

        $methodToStart($params);
    }
}