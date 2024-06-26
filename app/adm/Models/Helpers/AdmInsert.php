<?php

namespace Adm\Models\Helpers;

use Adm\Models\Conn;
use PDO;
use PDOException;

class AdmInsert
{

    private array $data;
    private string $columns;
    private string $values;
    private object $connect;

    public function insert(string $table, array $data)
    {
        $this->setConnect();

        $this->data = $data;
        $this->formatData();

        try {
            $query = $this->connect->prepare("INSERT INTO {$table}($this->columns) VALUES ($this->values)");

            if ($query->execute($this->data)) {
                return $query;
            }

            return false;
        } catch (PDOException $err) {
            throw $err;
        }

    }

    private function formatData()
    {
        $this->columns = implode(", ", array_keys($this->data));
        $this->values = ":" . implode(", :", array_keys($this->data));
    }

    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}