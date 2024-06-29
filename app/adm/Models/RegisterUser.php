<?php

namespace Adm\Models;

use Adm\Models\Encryption;
use PDOException;
use PDO;

class RegisterUser
{
    private object $connect;
    private object $encryption;

    public function formatData($userData): array
    {
        $this->encryption = new Encryption;

        foreach ($userData as $key => $value) {
            $value = trim($value);
            $userData[$key] = (!empty($value)) ? (($key == "razao") ? strtoupper($value) : $value) : null;
        }
        $userData['situacao'] = (!empty($userData['situacao']) || isset($userData['situacao'])) ? strtolower($userData['situacao']) : null;
        $userData['tef'] = (!empty($userData['tef']) || isset($userData['tef'])) ? strtolower($userData['tef']) : null;
        $userData['nfe'] = (!empty($userData['nfe']) || isset($userData['nfe'])) ? strtolower($userData['nfe']) : null;
        $userData['sped'] = (!empty($userData['sped']) || isset($userData['sped'])) ? strtolower($userData['sped']) : null;
        $userData['senha'] = (!empty($userData['senha'])) ? $this->encryption->encrypt($userData['senha']) : null;
        $userData['senha_backup'] = (!empty($userData['senha_backup'])) ? $this->encryption->encrypt($userData['senha_backup']) : null;

        return $userData;
    }


    public function registerCliente($userData)
    {
        $this->setConnect();

        $userData = $this->formatData($userData);

        try {
            $personInsert = $this->connect->prepare("INSERT INTO `PESSOAS`(
                `NOME`,
                `RAZAO`, 
                `LOGRADOURO`, 
                `NUMERO`, 
                `BAIRRO`, 
                `CIDADE`, 
                `CEP`, 
                `UF`, 
                `CNPJ`, 
                `IE`, 
                `CONTATO`, 
                `SISTEMA`, 
                `SERIAL`,
                `OBS`, 
                `VEN_CERT`, 
                `EMAIL`, 
                `SITUACAO`, 
                `TEF`, 
                `NFE`, 
                `SPED`, 
                `CONTADOR`, 
                `EMAIL_BACKUP`, 
                `SENHA_BACKUP`, 
                `TIPO`) 
                VALUES (
                    :nome, 
                    :razao, 
                    :logradouro, 
                    :numero, 
                    :bairro, 
                    :cidade, 
                    :cep, 
                    :uf, 
                    :cnpj, 
                    :ie, 
                    :contato, 
                    :sistema, 
                    :serial, 
                    :obs, 
                    :ven_cert, 
                    :email, 
                    :situacao, 
                    :tef, 
                    :nfe, 
                    :sped, 
                    :contador, 
                    :email_backup, 
                    :senha_backup, 
                    :tipo)"
            );

            $personInsert->bindParam(":nome", $userData["name"]);
            $personInsert->bindParam(":razao", $userData["razao"]);
            $personInsert->bindParam(":logradouro", $userData["logradouro"]);
            $personInsert->bindParam(":numero", $userData["numero"]);
            $personInsert->bindParam(":bairro", $userData["bairro"]);
            $personInsert->bindParam(":cidade", $userData["cidade"]);
            $personInsert->bindParam(":cep", $userData["cep"]);
            $personInsert->bindParam(":uf", $userData["uf"]);
            $personInsert->bindParam(":cnpj", $userData["cnpj"]);
            $personInsert->bindParam(":ie", $userData["ie"]);
            $personInsert->bindParam(":contato", $userData["contato"]);
            $personInsert->bindParam(":sistema", $userData["sistema"]);
            $personInsert->bindParam(":serial", $userData["serial"]);
            $personInsert->bindParam(":obs", $userData["obs"]);
            $personInsert->bindParam(":ven_cert", $userData["ven_cert"]);
            $personInsert->bindParam(":email", $userData["email"]);
            $personInsert->bindParam(":situacao", $userData["situacao"]);
            $personInsert->bindParam(":tef", $userData["tef"]);
            $personInsert->bindParam(":nfe", $userData["nfe"]);
            $personInsert->bindParam(":sped", $userData["sped"]);
            $personInsert->bindParam(":contador", $userData["contador"]);
            $personInsert->bindParam(":email_backup", $userData["email_backup"]);
            $personInsert->bindParam(":senha_backup", $userData["senha_backup"]);
            $personInsert->bindParam(":tipo", $userData["type"]);

            if ($personInsert->execute()) {
                return "data insert succeed";
            }

        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function registerContador($userData)
    {
        $this->setConnect();

        $userData = $this->formatData($userData);

        try {
            $personInsert = $this->connect->prepare("INSERT INTO `PESSOAS`(
                `NOME`,
                `RAZAO`, 
                `LOGRADOURO`, 
                `NUMERO`, 
                `BAIRRO`, 
                `CIDADE`, 
                `CEP`, 
                `UF`, 
                `CNPJ`, 
                `IE`, 
                `CONTATO`, 
                `SISTEMA`, 
                `SERIAL`,
                `OBS`, 
                `VEN_CERT`, 
                `EMAIL`, 
                `SITUACAO`, 
                `TEF`, 
                `NFE`, 
                `SPED`, 
                `CONTADOR`, 
                `EMAIL_BACKUP`, 
                `SENHA_BACKUP`, 
                `TIPO`) 
                VALUES (
                    :nome, 
                    :razao, 
                    :logradouro, 
                    :numero, 
                    :bairro, 
                    :cidade, 
                    :cep, 
                    :uf, 
                    :cnpj, 
                    :ie, 
                    :contato, 
                    :sistema, 
                    :serial, 
                    :obs, 
                    :ven_cert, 
                    :email, 
                    :situacao, 
                    :tef, 
                    :nfe, 
                    :sped, 
                    :contador, 
                    :email_backup, 
                    :senha_backup, 
                    :tipo)"
            );

            $personInsert->bindParam(":nome", $userData["name"]);
            $personInsert->bindParam(":razao", $userData["razao"]);
            $personInsert->bindParam(":logradouro", $userData["logradouro"]);
            $personInsert->bindParam(":numero", $userData["numero"]);
            $personInsert->bindParam(":bairro", $userData["bairro"]);
            $personInsert->bindParam(":cidade", $userData["cidade"]);
            $personInsert->bindParam(":cep", $userData["cep"]);
            $personInsert->bindParam(":uf", $userData["uf"]);
            $personInsert->bindParam(":cnpj", $userData["cnpj"]);
            $personInsert->bindParam(":ie", $userData["ie"]);
            $personInsert->bindParam(":contato", $userData["contato"]);
            $personInsert->bindParam(":sistema", $userData["sistema"]);
            $personInsert->bindParam(":serial", $userData["serial"]);
            $personInsert->bindParam(":obs", $userData["obs"]);
            $personInsert->bindParam(":ven_cert", $userData["ven_cert"]);
            $personInsert->bindParam(":email", $userData["email"]);
            $personInsert->bindParam(":situacao", $userData["situacao"]);
            $personInsert->bindParam(":tef", $userData["tef"]);
            $personInsert->bindParam(":nfe", $userData["nfe"]);
            $personInsert->bindParam(":sped", $userData["sped"]);
            $personInsert->bindParam(":contador", $userData["contador"]);
            $personInsert->bindParam(":email_backup", $userData["email_backup"]);
            $personInsert->bindParam(":senha_backup", $userData["senha_backup"]);
            $personInsert->bindParam(":tipo", $userData["type"]);

            $userInsert = $this->connect->prepare("INSERT INTO `USUARIOS`(
                `LOGIN`, 
                `SENHA`, 
                `SITUACAO`, 
                `TIPO`) 
                VALUES (
                :login,
                :senha,
                :situacao,
                :tipo)"
            );

            $userInsert->bindParam(":login", $userData["name"]);
            $userInsert->bindParam(":senha", $userData["senha"]);
            $userInsert->bindParam(":situacao", $userData["situacao"]);
            $userInsert->bindParam(":tipo", $userData["type"]);

            if ($userInsert->execute() && $personInsert->execute()) {
                return "data insert succeed";
            }

        } catch (PDOException $err) {
            throw $err;
        }
    }

    /**
     * @return 
     */
    public function getConnect(): ?object
    {
        return $this->connect;
    }

    /**
     * @param object $connect 
     * Seta a conexão com o banco
     */
    public function setConnect(): void
    {
        $connection = new Conn;
        $this->connect = $connection->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}