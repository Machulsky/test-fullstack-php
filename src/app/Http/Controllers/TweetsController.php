<?php

namespace App\Http\Controllers;
use Framework\Request;
use App\Entities\Tweet;
use Framework\Controller;

class TweetsController extends Controller{

    public function __construct(Request $request)
    {
        Parent::__construct($request);
        $this->resJSON();
    }

    public function index()
    {
        $tweet = new Tweet();
        echo json_encode([ 'success' => true, 'data' => $tweet->all()]);
    }

    public function create()
    {
        $tweet = new Tweet();
        $tweet->createTask($this->request->getEntries());
       
        echo json_encode([ 'success' => true, 'data' => $tweet->getLastTask()]);
        
    }

    public function find()
    {
        $tweet = new Tweet();
        echo json_encode([ 'success' => true, 'data' => $tweet->find(20)]);
    }
}