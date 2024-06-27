<?php

namespace Adm\Controllers;

use Adm\Models\Encryption;
use Adm\Models\Helpers\AdmDelete;
use Adm\Models\Helpers\AdmInsert;
use Adm\Models\Helpers\AdmSelect;
use Adm\Models\Helpers\AdmUpdate;
use Adm\Models\ListUsers;
use Adm\Models\RegisterUser;
use Core\ConfigView;
use PDOException;

function formatDateToDB(string $date): string
{
    return implode('-', array_reverse(explode('/', $date)));
}

function formatDateToHTML(string $date): string
{
    return implode('/', array_reverse(explode('-', $date)));
}

class Usuarios
{

    private array $data = [];
    private ?array $dataForm = null;
    private ?object $registerUser;
    private ?object $encryption;

    public function listar(?array $urlParameters = null)
    {
        $this->setEncryption();
        $listUsers = new ListUsers();
        $select = new AdmSelect();

        $this->dataForm = filter_input_array(INPUT_GET, FILTER_DEFAULT);
        unset($this->dataForm['url']);
        $offset = 0;
        $limit = 25;


        try {

            $this->data['allColumns'] = $select->columns("PESSOAS");
            unset($this->data['allColumns'][array_search("COD_PES", $this->data['allColumns'])]);
            unset($this->data['allColumns'][array_search("NOME", $this->data['allColumns'])]);

            if (isset($this->dataForm) && !empty($this->dataForm) && !isset($this->dataForm['result'])) {
                $this->data['type'] = (isset($this->dataForm['type'])) ? $this->dataForm['type'] : "Clientes";

                $this->data = array_merge($this->data, $this->dataForm);
                $this->data['page-limit'] = ceil($select->pagination($this->data['type'], $this->data['situacao'], $this->data['search'], $this->data['selectColumn']) / 25);
                $this->data['page'] = (!isset($this->data['page'])) ? 1 : $this->data['page'];
                $this->data['page'] = ($this->data['page'] > $this->data['page-limit']) ? $this->data['page-limit'] : $this->data['page'];

                if ($this->data['page'] > 1) {

                    $this->data['page'] = $urlParameters['page'];
                    $offset = ($limit * ($this->data['page'] - 1));
                }

                if (isset($this->dataForm['columns']) && !empty($this->dataForm['columns'])) {
                    $this->dataForm['columns'] = rtrim($this->dataForm['columns'], ";");

                    $selectedColumns = str_replace(";", ",", $this->dataForm['columns']);
                    $this->data['selectedColumns'] = explode(",", $selectedColumns);

                    $update = new AdmUpdate();
                    $update->update(["userId" => $_SESSION['user'], "columns" => $this->dataForm['columns']], "UserColumns");
                } else {
                    $selectedColumns = str_replace(";", ",", $select->select("COLUMNS", $_SESSION['user'])['columns']);
                    $this->data['selectedColumns'] = explode(",", $selectedColumns);
                }

                if (!empty($this->data['search'])) {
                    $resultQuery = $listUsers->search($offset, $limit, $this->data['situacao'], $this->data['search'], $this->data['selectColumn'], $this->data['type'], "," . $selectedColumns);
                    $this->data['data'] = $resultQuery;
                } else {
                    if ($this->data['type'] == "Clientes" || empty($this->data['type'])) {
                        $resultQuery = $listUsers->selectClientes($offset, $limit, $this->data['situacao'], "," . $selectedColumns);
                        $this->data['data'] = $resultQuery;
                    } else {
                        $resultQuery = $listUsers->selectContador($offset, $limit, $this->data['situacao'], "," . $selectedColumns);
                        $this->data['data'] = $resultQuery;
                    }
                }
            } else {
                if (!empty($select->select("COLUMNS", $_SESSION['user']))) {
                    $selectedColumns = str_replace(";", ",", $select->select("COLUMNS", $_SESSION['user'])['columns']);

                    $this->data['selectedColumns'] = explode(",", $selectedColumns);
                } else {
                    $insert = new AdmInsert();
                    $insert->insert("UserColumns", ["userId" => $_SESSION['user']]);
                    $selectedColumns = "CNPJ,IE,EMAIL";

                    $this->data['selectedColumns'] = explode(",", $selectedColumns);
                }

                $this->data['data'] = $listUsers->selectClientes($offset, $limit, 'Ativo', ",{$selectedColumns}");

                $this->data['data'] = array_map(function ($value) {
                    $value['VEN_CERT'] = implode('/', array_reverse(explode('-', $value['VEN_CERT'])));
                    return $value;
                }, $this->data['data']);

                $this->data['page-limit'] = ceil($select->pagination('Clientes', 'Ativo')) / 25;
            }
        } catch (PDOException $err) {
            $this->data['error'] = $err->getMessage();
        }

        if (isset($urlParameters['result'])) {
            $this->data['result'] = $urlParameters['result'];
        }

        $loadView = new ConfigView("adm/Views/users/users", $this->data);
        $loadView->renderView();
    }

    public function cadastrar(?array $urlParameters = null)
    {
        $this->registerUser = new RegisterUser();
        $select = new AdmSelect();

        try {
            $this->data['systs'] = $select->selectAll('SISTEMAS');
            $this->data['accountants'] = $select->selectAll('CONTADORES');
        } catch (PDOException $err) {
            $this->data['form'] = $this->dataForm;
            $this->data['result'] = $err->getMessage();
        }

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            $date = $this->dataForm['ven_cert'];
            $dbDate = formatDateToDB($date);

            $this->dataForm['type'] = (empty($this->dataForm['type'])) ? 'cliente' : strtolower($this->dataForm['type']);

            $this->dataForm['SITUACAO'] = (isset($this->dataForm['SITUACAO']) && $this->dataForm['SITUACAO'] == 'Ativo') ? 'SIM' : $this->dataForm['SITUACAO'];

            try {
                if ($this->dataForm['type'] == "cliente") {
                    $this->dataForm['ven_cert'] = $dbDate;
                    var_dump($this->registerUser->registerCliente($this->dataForm));
                } else {
                    $this->dataForm['ven_cert'] = $dbDate;
                    $this->registerUser->registerContador($this->dataForm);
                }
                $this->data['form']['name'] = $this->dataForm['name'];
            } catch (PDOException $err) {
                $this->dataForm['ven_cert'] = $date;
                $this->data['form'] = $this->dataForm;
                $this->data['result'] = $err->getMessage();
            }
        }

        $loadView = new ConfigView("adm/Views/users/form", $this->data);
        $loadView->renderView();
    }

    public function visualizar(?array $urlParameters = null)
    {
        $this->setEncryption();
        $select = new AdmSelect();

        if (isset($urlParameters)) {
            try {
                if (in_array($urlParameters['type'], ['Contador', 'contador', 'Contadores', 'contadores'])) {
                    $this->data['data'] = $select->select('CONTADORES', $urlParameters['id']);
                    $this->data['data']['senha_contador'] = (!is_null($this->data['data']['senha_contador'])) ? $this->encryption->decrypt($this->data['data']['senha_contador']) : $this->data['data']['senha_contador'];
                    $this->data['data']['SENHA_BACKUP'] = (!is_null($this->data['data']['SENHA_BACKUP'])) ? $this->encryption->decrypt($this->data['data']['SENHA_BACKUP']) : $this->data['data']['SENHA_BACKUP'];
                } elseif (in_array($urlParameters['type'], ['Cliente', 'cliente', 'Clientes', 'clientes', ""])) {
                    $this->data['data'] = $select->select('PESSOAS', $urlParameters['id']);
                    $this->data['data']['SENHA_BACKUP'] = (!is_null($this->data['data']['SENHA_BACKUP'])) ? $this->data['data']['SENHA_BACKUP'] : $this->data['data']['SENHA_BACKUP'];
                }

                $this->data['data']['VEN_CERT'] = formatDateToHTML($this->data['data']['VEN_CERT']);
            } catch (PDOException $err) {
                $this->data['error'] = $err->getMessage();
            }
        }

        $loadView = new ConfigView("adm/Views/users/visualize", $this->data);
        $loadView->renderView();
    }

    public function deletar(?array $urlParameters)
    {
        $delete = new AdmDelete;

        if (isset($urlParameters)) {
            try {

                if (in_array($urlParameters['type'], ['Contador', 'Contadores'])) {
                    $delete->delete($urlParameters['id'], $urlParameters['type'], $urlParameters['name']);
                    $this->data['result'] = "success";
                } elseif (in_array($urlParameters['type'], ['Cliente', 'Clientes', ""])) {
                    $delete->delete($urlParameters['id'], $urlParameters['type']);
                    $this->data['result'] = "success";
                }

                header("location:" . DEFAULT_URL . "usuarios/listar?result=success");
            } catch (PDOException $err) {
                $this->data['error'] = $err->getMessage();
                var_dump($err->getMessage());
            }
        }

        $loadView = new ConfigView("adm/Views/users/deletar", $this->data);
        $loadView->renderView();
    }

    public function editar(?array $urlParameters)
    {
        $this->setEncryption();
        $register = new RegisterUser();
        $select = new AdmSelect();
        $update = new AdmUpdate();
        $this->dataForm = (!empty($_POST)) ? $register->formatData(filter_input_array(INPUT_POST)) : $this->dataForm;
        $this->data['systems'] = $select->selectAll('SISTEMAS');
        $this->data['accountants'] = $select->selectAll('CONTADORES');

        if (isset($urlParameters['id']) && isset($urlParameters['type'])) {
            try {
                $this->data['form'] = (in_array($urlParameters['type'], ['Clientes', 'Cliente', "CLIENTE", "CLIENTES", ""]) || empty($urlParameters['type'])) ? $select->select('PESSOAS', $urlParameters['id']) : $select->select('CONTADORES', $urlParameters['id']);
                $this->data['form']['SENHA_BACKUP'] = (isset($this->data['form']['SENHA_BACKUP'])) ? $this->encryption->decrypt($this->data['form']['SENHA_BACKUP']) : $this->data['form']['SENHA_BACKUP'];
                $this->data['form']['senha_contador'] = (isset($this->data['form']['senha_contador'])) ? $this->encryption->decrypt($this->data['form']['senha_contador']) : NULL;
                $this->data['form']['VEN_CERT'] = formatDateToHTML($this->data['form']['VEN_CERT']);
            } catch (PDOException $err) {
                $this->data['error'] = $err->getMessage();
            }
        }


        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);


            try {
                $password = (isset($this->dataForm['senha'])) ? $this->encryption->encrypt($this->dataForm['senha']) : NULL;
                $passwordBackup = (isset($this->dataForm['senha_backup'])) ? $this->encryption->decrypt($this->dataForm['senha_backup']) : NULL;
                unset($this->dataForm['senha']);

                $this->dataForm['ven_cert'] = formatDateToDB($this->dataForm['ven_cert']);

                $update->update(array_merge(['COD_PES' => (int) $urlParameters['id']], $this->dataForm), 'PESSOAS');

                if ($this->dataForm['tipo'] == "contador") {
                    $update->update(['LOGIN' => $this->dataForm['nome'], 'SENHA' => $password, 'SITUACAO' => $this->dataForm['situacao'], 'TIPO' => $this->dataForm['tipo'], 'id' => $this->data['form']['NOME']], "USUARIOS");
                    $this->dataForm['senha'] = $password;
                }

                $this->data['result'] = "succeed";
                $this->dataForm['ven_cert'] = formatDateToHTML($this->dataForm['ven_cert']);
                $this->dataForm['senha_backup'] = $passwordBackup;

                $this->dataForm = array_change_key_case($this->dataForm, CASE_UPPER);

                $this->data['form'] = $this->dataForm;
                $this->data['form']['senha'] = (isset($password)) ? $this->encryption->decrypt($password) : NULL;
            } catch (PDOException $err) {
                $this->dataForm['ven_cert'] = formatDateToHTML($this->dataForm['ven_cert']);
                $this->data['result'] = $err->getMessage();
            }
        }

        $loadView = new ConfigView("adm/Views/users/editar", $this->data);
        $loadView->renderView();
    }


    /**
     * instancia a classe de criptografia
     */
    public function setEncryption()
    {
        $this->encryption = new Encryption();
    }
}
