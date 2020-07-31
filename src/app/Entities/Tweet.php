<?php

namespace App\Entities;

use Framework\Entity;

class Tweet extends Entity{
    protected $fillable = ['CategoryId', 'Username', 'Content', 'CreatedAt'];

    function __construct()
    {
        
    }
    
}