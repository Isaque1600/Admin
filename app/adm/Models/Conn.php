<?php

namespace Adm\Models;

use PDO;
use PDOException;

class Conn
{
    protected string $dbPort;
    protected string $dbHost;
    protected string $dbName;
    protected string $dbUser;
    protected string $dbPasswd;
    protected ?object $connection;

    public function connect()
    {
        $this->dbPort = $_ENV['DB_PORT'];
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_DATABASE'];
        $this->dbUser = $_ENV['DB_USERNAME'];
        $this->dbPasswd = $_ENV['DB_PASSWORD'];

        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";port=" . $this->dbPort . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPasswd);
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
