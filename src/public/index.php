<?php

define('ROUTES_DIR', __DIR__.'/../routes/');
define('CLIENT_DIR', __DIR__.'/../client/');
require __DIR__.'/../vendor/autoload.php';


$app = require_once __DIR__.'/../bootstrap/app.php';
$db = new Framework\DB();
$app->run();






