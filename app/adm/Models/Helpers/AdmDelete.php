<?php

namespace Adm\Models\Helpers;

use Adm\Models\Conn;
use PDO;
use PDOException;

class AdmDelete
{

    private object $connect;
    private string $table;

    public function delete(string $id, string $table, string $name = "")
    {
        $this->setConnect();
        $this->table = $table;

        try {

            $query = $this->tableForDelete();

            if ($this->table == "contador") {
                $data = [':id' => $id, ":name" => $name];
            } else {
                $data = [':id' => $id];
            }

            if ($query->execute($data)) {
                return "success";
            }

            return "fail";

        } catch (PDOException $err) {
            throw $err;
        }

    }

    private function tableForDelete()
    {
        switch ($this->table) {
            case 'cliente' or 'Cliente' or 'Clientes' or '':
                return $this->connect->prepare("DELETE FROM PESSOAS WHERE COD_PES = :id");

            case 'contador' or 'Contador' or 'Contadores':
                return $this->connect->prepare("DELETE `PESSOAS`.*, `USUARIOS`.* FROM `PESSOAS`, `USUARIOS` WHERE `PESSOAS`.`COD_PES` = :id and `USUARIOS`.LOGIN = :name");

            case 'SISTEMAS':
                return $this->connect->prepare("DELETE FROM SISTEMAS WHERE id = :id");
        }
    }

    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}