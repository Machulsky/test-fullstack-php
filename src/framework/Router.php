<?php

namespace Framework;

class Router {

    private $routes = [];
    

    public function __construct()
    {
        $this->loadRoutes();

    }

    private function loadRoutes()
    {
        $routesDir = scandir( ROUTES_DIR );
        unset($routesDir[0]);
        unset($routesDir[1]);
        foreach($routesDir as $routesFile){
            $routes = require_once ROUTES_DIR.$routesFile;
            $this->routes = array_merge($routes, $this->routes);
        }
    }

    public function match(Request $request)
    {
       

        foreach($this->routes as $route){
            
            if($route['url'] == $request->path() && strtoupper($route['method']) == strtoupper($request->method())){
                $controller = 'App\Http\Controllers';
                $controller .= '\\'.stristr($route['dispatch'], '@', true);
                $action = str_replace('@', '', stristr($route['dispatch'], '@'));
               
                return $this->dispatch($controller, $action, $request);
            }

            
        }

        echo 'Not found 404';
        return;

       
    }

    private function dispatch($controller, $action, $request)
    {
        $c = new $controller($request);

        return $c->$action();

    }
}