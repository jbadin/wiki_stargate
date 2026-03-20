<?php
session_start();
require_once 'router.php';

$router = new Router();

//Series routes
$router->addRoute('/create-series','series', 'create');

$router->dispatch();