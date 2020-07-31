<?php

namespace Framework;
use \PDO;
class DB{

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

    }

    public function query($sql = '')
    {
        return $this->conn->exec($sql);
    }

    public function getConn()
    {
        return $this->conn;
    }
}