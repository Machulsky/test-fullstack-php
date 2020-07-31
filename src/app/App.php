<?php

namespace App;

class App {
    private $router;
    private $request;

    function __construct($request, $router)
    {
        $this->router = $router;

        $this->request = $request;
       
    }

    public function run()
    {
        return $this->router->match($this->request);
    }
}