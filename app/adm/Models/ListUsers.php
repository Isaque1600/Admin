<?php

namespace Adm\Models;

use PDO;
use PDOException;

class ListUsers
{

    private object $connect;

    public function selectClientes(int $offset, int $limit, string $active, ?string $columns = "CNPJ, IE, EMAIL")
    {
        $this->setConnect();

        try {

            $query = "SELECT COD_PES, NOME{$columns} FROM PESSOAS WHERE tipo = 'cliente'";

            if ($active == "Ativo") {
                $query .= " AND SITUACAO = 'SIM'";
            } elseif ($active == "Inativo") {
                $query .= " AND SITUACAO <> 'SIM'";
            }

            $clientesData = $this->connect->prepare("$query ORDER BY NOME LIMIT :limit OFFSET :offset");

            $clientesData->bindParam(':offset', $offset, PDO::PARAM_INT);
            $clientesData->bindParam(':limit', $limit, PDO::PARAM_INT);

            if ($clientesData->execute()) {
                return $clientesData->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function selectContador(int $offset, int $limit, string $active, string $columns)
    {
        $this->setConnect();

        try {

            $query = "SELECT COD_PES, NOME, senha_contador{$columns} FROM Contadores";

            if ($active == "Ativo") {
                $query .= " WHERE SITUACAO = 'SIM'";
            } elseif ($active == "Inativo") {
                $query .= " WHERE SITUACAO <> 'SIM'";
            }

            $contadorData = $this->connect->prepare("$query ORDER BY NOME LIMIT :limit OFFSET :offset");

            $contadorData->bindParam(':offset', $offset, PDO::PARAM_INT);
            $contadorData->bindParam(':limit', $limit, PDO::PARAM_INT);

            if ($contadorData->execute()) {
                return $contadorData->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function search(int $offset, int $limit, string $active, string $search, string $column, string $type, string $columns = "CNPJ, IE, EMAIL")
    {

        $this->setConnect();

        try {

            $query = ($type == "Clientes") ? "SELECT COD_PES, NOME{$columns} FROM PESSOAS WHERE tipo = 'cliente' AND $column LIKE CONCAT('%', :search, '%')" : "SELECT COD_PES, NOME{$columns} FROM Contadores WHERE NOME LIKE CONCAT('%', :search, '%')";

            if ($active == "Ativos") {
                $query .= " AND SITUACAO = 'SIM'";
            } elseif ($active == "Inativos") {
                $query .= " AND SITUACAO <> 'SIM'";
            }

            $searchData = $this->connect->prepare($query . " ORDER BY $column LIMIT :limit OFFSET :offset");

            $searchData->bindParam(':offset', $offset, PDO::PARAM_INT);
            $searchData->bindParam(':limit', $limit, PDO::PARAM_INT);
            $searchData->bindParam(':search', $search, PDO::PARAM_STR);

            if ($searchData->execute()) {
                return $searchData->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $err) {
            throw $err;
        }

    }

    /**
     * @param object $connect 
     * @return void connected with database
     */
    public function setConnect(): void
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}