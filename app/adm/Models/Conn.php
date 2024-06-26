<?php

namespace Adm\Models;

use PDO;
use PDOException;

class Conn
{

    protected string $dbType;
    protected string $dbPort;
    protected string $dbHost;
    protected string $dbName;
    protected string $dbUser;
    protected string $dbPasswd;
    protected ?object $connection;

    public function connect(
        string $dbType = $_ENV['DB_DRIVER'],
        string $dbPort = $_ENV['DB_PORT'],
        string $dbHost = $_ENV['DB_HOST'],
        string $dbName = $_ENV['DB_DATABASE'],
        string $dbUser = $_ENV['DB_USERNAME'],
        string $dbPasswd = $_ENV['DB_PASSWORD']
    ) {
        $this->dbType = $dbType;
        $this->dbPort = $dbPort;
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPasswd = $dbPasswd;

        try {
            $this->connection = new PDO("{$this->dbType}:host=" . $this->dbHost . ";port=" . $this->dbPort . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPasswd);
            return $this->getConnection();
        } catch (PDOException $err) {
            die("ERROR: CONNECTION WITH DATA BASE NOT ESTABLISHED" . $err);
        }
    }

    /**
     * @return object of PDO connect
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
