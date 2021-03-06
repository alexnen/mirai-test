<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/loader.php';

use App\Services\App;

App::load();

/** @var \App\Services\Router $router*/
$router = App::get('router')->exec();

//try {
    App::start($router);
//} catch (Throwable $e) {
//    http_response_code($e->getCode());
//    exit;
//}

