<?php

define('ROUTES_DIR', __DIR__.'/../routes/');

require __DIR__.'/../vendor/autoload.php';


$app = require_once __DIR__.'/../bootstrap/app.php';

$app->run();






