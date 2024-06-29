<?php

namespace Adm\Models\Helpers;

use Adm\Models\Conn;
use PDO;
use PDOException;

class AdmUpdate
{
    private object $connect;
    private array $data;
    private string $table;
    private string $columnsQuery;
    private string $id;

    public function update(array $data, string $table)
    {
        $this->setConnect();
        $this->data = $data;
        $this->table = $table;
        if ($this->table != "USUARIOS") {
            $this->formatData();
        }

        try {



            if ($this->table == "USUARIOS") {
                $query = $this->connect->prepare("UPDATE $this->table SET LOGIN = :LOGIN, SENHA = :SENHA, SITUACAO = :SITUACAO, TIPO = :TIPO WHERE LOGIN = :id");

                if ($query->execute([':LOGIN' => $this->data['LOGIN'], ':SENHA' => $this->data['SENHA'], ':SITUACAO' => $this->data['SITUACAO'], ':TIPO' => $this->data['TIPO'], ':id' => $this->data['id']])) {
                    return "succeed";
                }

                return $query;
            }

            $query = $this->connect->prepare("UPDATE $this->table SET $this->columnsQuery WHERE $this->id");

            if ($query->execute($this->data)) {
                return "succeed";
            }

            return $query;

        } catch (PDOException $err) {
            var_dump($query);
            throw $err;
        }

    }

    private function formatData()
    {
        $this->id = "" . array_key_first($this->data) . " = :" . array_key_first($this->data);
        $this->columnsQuery = $this->updateMap();

    }

    private function addPrefixForKeys()
    {
        return array_combine(array_map(fn($key) => ":{$key}", array_keys($this->data)), array_keys($this->data));
    }

    private function updateMap()
    {
        // array with values(items)
        $valueList = $this->addPrefixForKeys();

        // reduce is picking the keys and the items of $valueList and applying the callback
        // callback is returning a string that is "$value = $key, ...", until the initial array is all iterated
        return array_reduce(
            array_keys($valueList),
            function ($carry, $key) use ($valueList) {
                if ($key == array_key_last($valueList)) {
                    return $carry . "" . $valueList[$key] . " = " . $key;
                }
                return $carry . "" . $valueList[$key] . " = " . $key . ", ";
            },
            ""
        );
    }

    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}