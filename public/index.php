<?php

ini_set('display_errors', true);

// Inicializálás és Composer autoload betöltése
require_once '../vendor/autoload.php';

use NeosoftApi\Router\Router;


$router = new Router();
$router->addRoute('GET', '/api/users', 'UserController@getUsers');
$router->addRoute('POST', '/api/users/auth', 'UserController@authUser');
$router->route();
