<?php

namespace Adm\Models;

use PDO;

class ChartDataSelect
{

    private object $connect;

    public function getChartData()
    {
        $this->setConnect();

        try {

            $query = $this->getAccountants()->fetchAll(PDO::FETCH_COLUMN);

            foreach ($query as $key => $value) {
                $finalQueries = $this->connect->prepare("SELECT count(CONTADOR) as quantidade FROM PESSOAS WHERE CONTADOR = :name AND SITUACAO = 'SIM'");

                if ($finalQueries->execute([':name' => $value])) {
                    $data[ucfirst($value)] = (int) $finalQueries->fetch(PDO::FETCH_COLUMN);
                }
            }

            return $data;

        } catch (\PDOException $err) {
            throw $err;
        }

    }

    public function getChartDataSped()
    {
        $this->setConnect();

        try {

            $query = $this->getAccountants()->fetchAll(PDO::FETCH_COLUMN);

            foreach ($query as $key => $value) {
                $finalQueries = $this->connect->prepare("SELECT count(CONTADOR) as quantidade FROM PESSOAS WHERE CONTADOR = :name AND SITUACAO = 'SIM' AND SPED = 'SIM'");

                if ($finalQueries->execute([':name' => $value])) {
                    $data[ucfirst($value)] = (int) $finalQueries->fetch(PDO::FETCH_COLUMN);
                }
            }

            return $data;

        } catch (\PDOException $err) {
            throw $err;
        }
    }

    private function getAccountants()
    {
        try {
            $query = $this->connect->prepare("SELECT NOME FROM Contadores");

            if ($query->execute()) {
                return $query;
            }
        } catch (\PDOException $err) {
            throw $err;
        }
    }

    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
