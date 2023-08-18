<?php

include_once "app/inc/default.inc.php";
require_once "vendor/autoload.php";

use Core\Router;

$router = new Router();
$router->route(
    parse_url(
        $_SERVER['REQUEST_URI'],
        PHP_URL_PATH
    )
);
