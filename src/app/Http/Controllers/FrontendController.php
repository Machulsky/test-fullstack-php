<?php

namespace App\Http\Controllers;
use Framework\Request;
use Framework\Controller;

class FrontendController extends Controller{
   

    public function index()
    {
        echo file_get_contents(CLIENT_DIR.'index.html');

    }
}