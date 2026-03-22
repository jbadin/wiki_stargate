<?php
session_start();
require_once 'router.php';

$router = new Router();

//Series routes
$router->addRoute('/creer-serie','series', 'create');
$router->addRoute('/modifier-serie','series', 'update');
$router->addRoute('/serie','series', 'details');
$router->addRoute('/liste-series','series', 'list'); 

$router->dispatch();