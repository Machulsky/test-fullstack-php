<?php

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../bootstrap/configs.php';

$client = new \Predis\Client([
    'scheme' => REDIS_SCHEME,
    'host' => REDIS_HOST,
    'port' => REDIS_PORT,
    'database' => REDIS_DB,
    'read_write_timeout' => REDIS_TIMEOUT
]);

while(true){
    try{
        $tweet = new \App\Entities\Tweet();
        $task = $tweet->deleteLastTask();
        if($task){

            

            $newTweet = $tweet->create($task+ ['CreatedAt' => time()]);
            var_dump($newTweet);
            echo 'Task successfully completed with data:'. PHP_EOL;
            
            $getNewTweet = $tweet->find($newTweet);
            print_r($getNewTweet[0] );
            $client->publish('tweets:create', json_encode($getNewTweet[0]));

        }
        
    }catch (\Exception $e){
        echo 'Error while doing the task';
    }
   
}