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
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(':name', $name, PDO::PARAM_STR);
            } else {
                $query->bindParam(':id', $id, PDO::PARAM_INT);
            }

            if ($query->execute()) {
                return "success";
            }

            return "fail";

        } catch (PDOException $err) {
            throw $err;
        }

    }

    private function tableForDelete()
    {
        if (in_array($this->table, ['cliente', 'Cliente', 'Clientes', ''])) {
            return $this->connect->prepare("DELETE FROM PESSOAS WHERE COD_PES = :id");
        }
        if (in_array($this->table, ['Contador', 'Contadores', 'contador'])) {
            return $this->connect->prepare("DELETE `PESSOAS`.*, `USUARIOS`.* FROM `PESSOAS`, `USUARIOS` WHERE `PESSOAS`.`COD_PES` = :id and `USUARIOS`.LOGIN = :name");
        }
        if (in_array($this->table, ['SISTEMAS'])) {
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