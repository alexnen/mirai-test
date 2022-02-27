<?php

namespace App\Helpers;

use App\Services\App;

class Helper
{
    public static function getConfig(string $conf)
    {
        $config = App::getConfig();

        $neededConfig = explode('.', $conf);

        foreach ($neededConfig as $key) {
            if(isset($config[$key])) {
                $config = $config[$key];
            } else {
                return null;
            }
        }

        return $config;
    }
}