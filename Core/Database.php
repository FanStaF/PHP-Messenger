<?php

namespace Core;

use PDO;

/**
 * Database class for interacting with the database.
 *  Local:
 *      db 'messenger'
 *      user 'root'
 *      password ''
 *  messenger.fanstaf.com:
 *      db 'fanstafc_messanger':
 *      user 'fanstafc_messanger'
 *      password '4k7]D,9GLbQQ'
 */
class Database
{
    /**
     * Holds configuration for database.
     * 
     * @var array
     */
    protected $config = [
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => 'messenger',
        'charset' => 'utf8mb4'
    ];
    /**
     * username for database
     * @var string
     */
    protected $username = 'root';
    /**
     * Password for database
     * @var string
     */
    protected $password = '';

    /**
     * PDO object for connecting to database
     * @var PDO
     */
    public $connection;
    /**
     * SQL-string to query database
     * @var string
     */
    public $statement;

    /**
     * Create PDO object to connect to databse
     */
    public function __construct()
    {
        $dsn = 'mysql:' . http_build_query($this->config, '', ';');

        $this->connection = new PDO($dsn, $this->username, $this->password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * Sends query to database
     * @param string $query
     * @param mixed $params
     * @return Database
     */
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    /**
     * Finds and returns one record from database.
     * @return mixed
     */
    public function find()
    {
        return $this->statement->fetch();
    }

    /**
     * Returns one one colum from one record.
     * 
     * @return mixed
     */
    public function getString()
    {
        return $this->statement->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * Returns all matching records.
     * 
     * @return array
     */
    public function getAll()
    {
        return $this->statement->fetchAll();
    }

    /**
     * Returns one column from all matching record
     * 
     * @return array
     */
    public function getColumn()
    {
        return $this->statement->fetchAll(PDO::FETCH_COLUMN);
    }
}