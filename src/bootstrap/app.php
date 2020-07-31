<?php
require_once __DIR__.'/configs.php';

$request = new Framework\Request();

$router = new Framework\Router();

$app = new App\App($request, $router);


return $app;