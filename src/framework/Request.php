<?php

namespace Framework;

class Request {

    private $storage; 


    public function __construct() {
        $request = json_decode(file_get_contents('php://input'), true);
        $this->storage = $this->cleanInput($request);
    }

    public function __get($name) {
        if (isset($this->storage[$name])) return $this->storage[$name];
    }

    private function filterPath()
    {    

       stristr($_SERVER['REQUEST_URI'], '?', true) ? $path = stristr($_SERVER['REQUEST_URI'], '?', true) : $path = $_SERVER['REQUEST_URI'];
       
        //$path = rtrim($path, '/');
        return $path;
    }

    public static function filterUri($uri)
    {
        
        return $uri;
    }

    public function path()
    {
       
        
        return $this->filterPath();
    }
   
    private function cleanInput($data) {
       
        if (is_array($data)) {
            $cleaned = [];
            
            foreach ($data as $key => $value) {
                
                $cleaned[$key] = $this->cleanInput($value);
            }

            return $cleaned;
        }

        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function input($name = '')
    {
        return $this->storage[$name] ?? false;
    }

    public function getEntries()
    {
        return $this->storage;
    }

    
    
}