<?php

namespace App\Entities;

use Framework\Entity;

class Category extends Entity{
    protected $table = 'categories';
    protected $fillable = ['Title'];

    public function all()
    {
        $sql = 'SELECT * FROM '.$this->table;
        return $this->dbConn->query($sql);
    }
}