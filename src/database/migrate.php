<?php
require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../bootstrap/configs.php';




$db = new Framework\DB();

$files = scandir(__DIR__.'/migrations');
unset($files[0]);
unset($files[1]);

foreach($files as $file){
    $sql = file_get_contents(__DIR__.'/migrations/'.$file);
    var_dump($sql);
    var_dump($db->query($sql));
    sleep(2);
}
