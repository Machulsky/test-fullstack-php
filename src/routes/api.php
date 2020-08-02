<?php

$routes = [
    [ 
        'method'=>'GET', 
        'url' => '/tweets', 
        'dispatch' => 'TweetsController@index' 
    ],

    [ 
        'method'=>'POST', 
        'url' => '/tweets', 
        'dispatch' => 'TweetsController@create' 
    ],

    [
        'method' => 'GET',
        'url' => '/categories',
        'dispatch' => 'CategoriesController@index' 
    ],
];

return $routes;