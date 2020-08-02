<?php

namespace App\Entities;

use Framework\Entity;

class Tweet extends Entity{

    protected $taskQ = 'createTweetQ';
    protected $fillable = ['CategoryId', 'Username', 'Content', 'CreatedAt'];
    protected $table = 'tveets';

    public function all()
    {
        $sql = 'SELECT c.title AS Category, t.Id, t.Content, t.Username, t.CreatedAt FROM '.$this->table.' AS t 
        LEFT JOIN categories AS c
        ON t.CategoryId = c.Id
        ORDER BY CreatedAt DESC
        ';
        return $this->dbConn->query($sql);
    }

    public function find($id)
    {
        $sql = 'SELECT c.title AS Category, t.Id, t.Content, t.Username, t.CreatedAt FROM '.$this->table.' AS t 
        INNER JOIN categories AS c
        ON t.CategoryId = c.Id
        WHERE t.Id = ?
        ORDER BY CreatedAt
        ';
        $stmt = $this->dbConn->query($sql, [$id]);
       

        return  $stmt;
    }
    
}