<?php

namespace App\Http\Controllers;
use Framework\Request;
use App\Entities\Category;
use Framework\Controller;

class CategoriesController extends Controller{
    public function __construct(Request $request)
    {
        Parent::__construct($request);
        $this->resJSON();
    }
    public function index()
    {
        $tweet = new Category();
        echo json_encode([ 'success' => true, 'data' => $tweet->all()]);
    }
}