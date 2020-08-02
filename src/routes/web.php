<?php

$routes = [
    [ 
        'method'=>'GET', 
        'url' => '/', 
        'dispatch' => 'FrontendController@index' 
    ]
];

return $routes;