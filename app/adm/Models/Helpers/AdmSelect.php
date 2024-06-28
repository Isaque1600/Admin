<?php

namespace Adm\Models\Helpers;

use Adm\Models\Conn;
use PDO;
use PDOException;
use Exception;

class AdmSelect
{

    private object $connect;

    public function selectAll(string $table)
    {
        $this->setConnect();

        try {

            $query = $this->tableForSelect($table);

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

            return null;

        } catch (PDOException $err) {
            throw $err;
        } catch (Exception $err) {
            throw $err;
        }

    }

    public function select(string $table, string $id)
    {
        $this->setConnect();

        try {

            $query = $this->tableForSelect($table, "SPECIFIC");

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            if ($query->execute()) {
                return $query->fetch(PDO::FETCH_ASSOC);
            }
            return $query;

        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function count(string $table)
    {
        $this->setConnect();

        try {

            $query = $this->tableForSelect($table);

            if ($query->execute()) {
                return $query->rowCount();
            }

            return null;

        } catch (PDOException $err) {
            throw $err;
        } catch (Exception $err) {
            throw $err;
        }
    }

    public function columns(string $table)
    {

        $this->setConnect();

        try {

            $query = $this->connect->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table");
            $query->bindParam(':table', $table, PDO::PARAM_STR);

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_COLUMN);
            }

            return null;

        } catch (PDOException $err) {
            throw $err;
        } catch (Exception $err) {
            throw $err;
        }

    }

    public function pagination(string $type = "Clientes", string $active = "Ativos", string $search = "", string $selectColumn = "NOME")
    {
        $this->setConnect();

        try {

            $query = ($type == "Clientes") ? "SELECT COD_PES FROM PESSOAS WHERE TIPO = 'cliente' AND $selectColumn LIKE :search ORDER BY $selectColumn " : "SELECT COD_PES FROM Contadores WHERE $selectColumn LIKE :search ORDER BY $selectColumn ";

            if ($active == "Ativos") {
                $query .= " AND SITUACAO = 'ativo' OR SITUACAO = 'SIM'";
            } elseif ($active == "Inativos") {
                $query .= " AND SITUACAO = 'NÃO' OR SITUACAO = 'inativo'";
            }

            $query = $this->connect->prepare($query);

            $search = "%$search%";

            $query->bindParam(':search', $search, PDO::PARAM_STR);

            if ($query->execute()) {
                return $query->rowCount();
            }

        } catch (PDOException $err) {
            throw $err;
        } catch (Exception $err) {
            throw $err;
        }
    }

    private function tableForSelect(string $table, string $type = 'ALL')
    {
        if ($type == "ALL") {
            switch ($table) {

                case 'SISTEMAS':
                    return $this->connect->prepare("SELECT * FROM SISTEMAS ORDER BY id");

                case 'PESSOAS':
                    return $this->connect->prepare("SELECT * FROM PESSOAS ORDER BY COD_PES");

                case 'PESSOAS-CLI':
                    return $this->connect->prepare("SELECT * FROM PESSOAS WHERE TIPO = 'cliente' ORDER BY COD_PES");

                case 'CONTADORES':
                    return $this->connect->prepare("SELECT * FROM Contadores ORDER BY COD_PES");

                case 'USUARIOS':
                    return $this->connect->prepare("SELECT * FROM USUARIOS ORDER BY id");

                default:
                    throw new Exception("Unknown Table", 1);


            }
        } else {
            switch ($table) {

                case 'SISTEMAS':
                    return $this->connect->prepare("SELECT * FROM SISTEMAS WHERE id = :id ORDER BY id ");

                case 'PESSOAS':
                    return $this->connect->prepare("SELECT * FROM PESSOAS WHERE COD_PES = :id ORDER BY COD_PES ");

                case 'CONTADORES':
                    return $this->connect->prepare("SELECT * FROM Contadores WHERE COD_PES = :id ORDER BY COD_PES ");

                case 'USUARIOS':
                    return $this->connect->prepare("SELECT * FROM USUARIOS WHERE COD_PES = :id ORDER BY COD_PES ");

                case 'THEME':
                    return $this->connect->prepare("SELECT * FROM THEME WHERE personId = :id ORDER BY personId");

                case 'COLUMNS':
                    return $this->connect->prepare("SELECT * FROM UserColumns WHERE userId = :id ORDER BY userId");

                default:
                    throw new Exception("Unknown Table", 1);

            }
        }
    }


    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}