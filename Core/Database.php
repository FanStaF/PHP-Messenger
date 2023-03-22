<?php

namespace Core;
use PDO;

class Database
{
// Database config
    protected $config = [
            'host' => 'localhost',
            'port' => '3306',
            'dbname' => 'messanger',
            'charset' => 'utf8mb4'
    ];
    protected $username = 'root';
    protected $password = '';

//Public variables
    public $connection;
    public $statement;

//Constructor
    public function __construct()
    {
        $dsn = 'mysql:' . http_build_query($this->config, '', ';');
           
           $this->connection = new PDO($dsn, $this->username, $this->password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    
    
    }

// Query
    public function query($query, $params = []){

    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);

    return $this;

    }
    
    public function find(){

        return $this->statement->fetch();
    }

    public function getAll(){

        return $this->statement->fetchAll();
    }

}