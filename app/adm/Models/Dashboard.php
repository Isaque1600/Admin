<?php

namespace Adm\Models;

use PDO;
use PDOException;

class Dashboard
{
    private object $connect;

    public function selectSyst(string $system, string $name)
    {
        $this->setConnect();

        try {

            switch ($system) {
                case 'TEF':
                    $query = $this->connect->prepare("SELECT count(COD_PES) as soma FROM PESSOAS WHERE TEF = :system and SITUACAO = 'SIM'");
                    break;

                case 'SYSTEM':
                    $query = $this->connect->prepare("SELECT count(COD_PES) as soma FROM PESSOAS WHERE SISTEMA = :system and SITUACAO = 'SIM'");
                    break;
            }

            $query->bindParam(':system', $name);

            if ($query->execute()) {
                return $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            throw $err;
        }

    }

    public function selectPersons(string $type)
    {
        $this->setConnect();

        try {

            switch ($type) {
                case 'cliente':
                    $query = $this->connect->prepare("SELECT count(COD_PES) as soma FROM PESSOAS WHERE TIPO = 'cliente' and SITUACAO = 'SIM'");
                    break;

                case 'contador':
                    $query = $this->connect->prepare("SELECT count(COD_PES) as soma FROM PESSOAS WHERE TIPO = 'contador' and SITUACAO = 'SIM'");
                    break;
            }

            if ($query->execute()) {
                return $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            throw $err;
        }
    }

    /**
     * Seta conexão com o banco
     * @return void
     */
    public function setConnect()
    {
        $connect = new Conn();
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
