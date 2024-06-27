<?php

namespace Adm\Controllers;

use Adm\Models\Helpers\AdmSelect;
use Adm\Models\Helpers\ChartJSONConstruct;
use Adm\Models\ChartDataSelect;
use Core\ConfigView;

class Relatorio
{

    public ?array $data = [];
    public ?array $dataForm;

    public function index($urlParameters = null)
    {
        $loadView = new ConfigView('adm/Views/reports/reports', $this->data);
        $loadView->renderView();
    }

    public function getChartSped($urlParameters = null)
    {
        $object = new ChartJSONConstruct();
        $select = new ChartDataSelect();

        try {
            $this->data['data'] = $select->getChartDataSped();
        } catch (\PDOException $err) {
            $this->data['error'] = $err->getMessage();
        }

        $name = 'SPED de Clientes p/Contador';
        $cols = ['Contadores' => "string", 'Qtd' => 'number'];
        $rows = $this->data['data'];

        $this->data['json'] = $object->getJson($name, $cols, $rows);

        $loadView = new ConfigView('adm/Views/reports/getchart', $this->data);
        $loadView->renderView();
    }

    public function getChart($urlParameters = null)
    {
        $object = new ChartJSONConstruct();
        $select = new ChartDataSelect();

        try {
            $this->data['data'] = $select->getChartData();
        } catch (\PDOException $err) {
            $this->data['error'] = $err->getMessage();
        }

        $name = 'Quantidade de Clientes p/Contador';
        $cols = ['Contadores' => "string", 'Qtd' => 'number'];
        $rows = $this->data['data'];

        $this->data['json'] = $object->getJson($name, $cols, $rows);

        $loadView = new ConfigView('adm/Views/reports/getchart', $this->data);
        $loadView->renderView();
    }

}
