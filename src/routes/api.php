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
];

return $routes;