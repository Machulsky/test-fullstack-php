<?php


namespace Framework;

class Controller {
    protected $request;
    function __construct(Request $request)
    {
        
        $this->request = $request;
    }

    protected function resJSON(){
        header('Content-type: Application/json');
    }
}