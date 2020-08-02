<?php

namespace Framework;

class Entity {
    protected $redisClient;
    protected $dbConn;
    protected $taskQ = 'createEntityQ';
    protected $fillable = [];
    protected $table = 'entities';
    protected $fields = [];

    public function __construct()
    {
        $this->redisClient = new \Predis\Client([
            'scheme' => REDIS_SCHEME,
            'host' => REDIS_HOST,
            'port' => REDIS_PORT,
            'database' => REDIS_DB,
            'read_write_timeout' => REDIS_TIMEOUT
        ]);

        $this->dbConn = new DB();
    }

    protected function pushCreateTask()
    {
        return $this->redisClient->lPush($this->taskQ, json_encode((array) $this->fields));

    }

    private function parseFields($fields = [])
    {
        foreach($fields as $key => $value){
            if(in_array($key, $this->fillable)){
                $this->fields[$key] = $value;

            } else{
                throw new \Exception('Field '. $key . ' is not fillable');
                
            }
        }
        
    }

    private function getValues()
    {
        $fields = $this->fields;
        $fillable = $this->fillable;
        $values = [];

        foreach($fillable as $field){
           
            $values[$field] = "'".$fields[$field]."'";
        }

        return $values;
    }

    private function filledFields()
    {
        $fields = $this->fields;
        $fillable = $this->fillable;
        $values = [];

        foreach($fillable as $field){
           if($fields[$field]) $values[] = $field;
        }
        return $values;
    }
    
    public function createTask($fields = [])
    {
        $this->parseFields($fields);

        return $this->pushCreateTask();

    }


    public function getLastTask()
    {
        return json_decode($this->redisClient->lindex($this->taskQ, 0), true);

    }

    public function deleteLastTask()
    {
        return json_decode($this->redisClient->rPop($this->taskQ), true);
    }

    public function all()
    {
        $sql = 'SELECT * FROM '.$this->table.' ORDER BY CreatedAt';
        return $this->dbConn->query($sql);

    }


    public function create($fields = [])
    {
        $this->parseFields($fields);
        
        $sql = 'INSERT INTO '.$this->table.' ('.implode( ',' ,$this->filledFields()).') 
            VALUES ('.rtrim(implode( ',' ,$this->getValues()), ',').')
        ';
      
       $this->dbConn->query($sql);
       return $this->dbConn->getConn()->lastInsertId();

    }
}