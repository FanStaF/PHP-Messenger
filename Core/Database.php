<?php

namespace Core;

use PDO;

//
// Database configuration and access
//
class Database
{
    // Local db 'messenger': user 'root' password ''
    // messenger.fanstaf.com db 'fanstafc_messanger': user 'fanstafc_messanger' password '4k7]D,9GLbQQ'
    //
    protected $config = [
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => 'messenger',
        'charset' => 'utf8mb4'
    ];
    protected $username = 'root';
    protected $password = '';

    // public variables
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
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    // Returns one whole record
    public function find()
    {
        return $this->statement->fetch();
    }

    // Returns one column from first matching record
    public function getString()
    {
        return $this->statement->fetch(PDO::FETCH_COLUMN);
    }

    // Returns all matching records
    public function getAll()
    {
        return $this->statement->fetchAll();
    }

    // Returns one column from all matching records
    public function getColumn()
    {
        return $this->statement->fetchAll(PDO::FETCH_COLUMN);
    }
}