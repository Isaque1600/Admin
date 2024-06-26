<?php

namespace Adm\Models\Helpers;

class ChartJSONConstruct
{
    private object $json;
    private array $cols;
    private array $rows;
    private string $name;

    public function __construct()
    {
        $this->json = new \stdClass;
    }

    /**
     * @param array $cols array with the columns [0] = type of column, [1] = label of column
     * @param int $qtdCols = quantity of columns the chart will has
     * @return self 
     */
    private function setCols(array $cols)
    {
        foreach ($cols as $key => $value) {
            $this->cols[] = array('type' => "$value", 'label' => "$key");
        }
        return $this;
    }

    /**
     * @param array $rows array with rows (keys = names, values = values :P)
     * @return self
     */
    private function setRows(array $rows)
    {
        foreach ($rows as $key => $value) {
            $values[] = array('v' => "$key");
            if (is_array($value)) {
                foreach ($value as $key => $value) {
                    $values[] = array("v" => "$value");
                }
            } else {
                $values[] = array("v" => "$value");
            }
            if (count($values) == count($this->cols)) {
                $this->rows[] = array("c" => $values);
                $values = [];
            }
        }
        return $this;
    }

    /**
     * @param string $name name of the chart
     * @return self
     */
    private function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    private function setJson(string $name, array $cols, array $rows)
    {

        $this->setName($name);
        $this->setCols($cols);
        $this->setRows($rows);

        $this->json->name = $this->name;
        $this->json->cols = $this->cols;
        $this->json->rows = $this->rows;
    }

    public function getJson(string $name, array $cols, array $rows)
    {
        $this->setJson($name, $cols, $rows);

        return json_encode($this->json);
    }
}
