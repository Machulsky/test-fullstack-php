<?php

namespace Framework;
use \PDO;
class DB{

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

    }

    public function query($sql = '', $data = [])
    {
        $sth = $this->conn->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(PDO::FETCH_OBJ);
        
    }

    public function lastInsertId()
    {
        
    }

    public function getConn()
    {
        return $this->conn;
    }
}