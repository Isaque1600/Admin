<?php

namespace Adm\Controllers;

use Adm\Models\Helpers\AdmDelete;
use Adm\Models\Helpers\AdmInsert;
use Adm\Models\Helpers\AdmSelect;
use Adm\Models\Helpers\AdmUpdate;
use Core\ConfigView;
use PDOException;

class Sistemas
{

    private ?array $data = [];
    private ?array $dataForm;

    public function listar(?array $urlParameters = null)
    {
        $select = new AdmSelect();

        try {
            $this->data['data'] = $select->selectAll('SISTEMAS');
        } catch (PDOException $err) {
            $this->data['error'] = $err->getMessage();
        }

        $loadView = new ConfigView('adm/Views/systems/systems', $this->data);
        $loadView->renderView();

    }

    public function cadastrar()
    {
        $insert = new AdmInsert();
        $this->dataForm = filter_input_array(INPUT_POST);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            try {
                $insert->insert('SISTEMAS', $this->dataForm);

                $this->data['result'] = "success";
            } catch (PDOException $err) {
                $this->data['result'] = $err->getCode();
                $this->data['form'] = $this->dataForm;
            }
        }

        $loadView = new ConfigView('adm/Views/systems/form', $this->data);
        $loadView->renderView();

    }

    public function visualizar(?array $urlParameters = null)
    {
        $select = new AdmSelect();

        if (isset($urlParameters['id'])) {
            try {
                $this->data['data'] = $select->select('SISTEMAS', $urlParameters['id']);
            } catch (PDOException $err) {
                header("location:" . DEFAULT_URL . "sistemas/listar");
            }

        }

        $loadView = new ConfigView('adm/Views/systems/visualize', $this->data);
        $loadView->renderView();
    }

    public function deletar(?array $urlParameters)
    {
        $delete = new AdmDelete();

        if (isset($urlParameters)) {
            try {
                $this->data['result'] = $delete->delete($urlParameters['id'], "SISTEMAS");

                header("location:" . DEFAULT_URL . "sistemas/listar?result=success");
            } catch (PDOException $err) {
                $this->data['error'] = $err->getMessage();
            }
        }
    }

    public function editar(?array $urlParameters)
    {
        $select = new AdmSelect();
        $update = new AdmUpdate();
        $this->dataForm = filter_input_array(INPUT_POST);

        if (isset($urlParameters['id'])) {
            try {
                $this->data['form'] = $select->select('SISTEMAS', $urlParameters['id']);
            } catch (PDOException $err) {
                $this->data['error'] = $err->getMessage();
            }
        }

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            try {
                $update->update(array_merge(['id' => (int) $urlParameters['id']], $this->dataForm), 'SISTEMAS');

                $this->data['result'] = "succeed";
                $this->data['form'] = $this->dataForm;
            } catch (PDOException $err) {
                $this->data['result'] = $err->getMessage();
            }

        }

        $loadView = new ConfigView("adm/Views/systems/editar", $this->data);
        $loadView->renderView();
    }


}