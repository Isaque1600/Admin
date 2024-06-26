<?php

namespace Core;

class ConfigView
{

    private string $name;
    private array $data;

    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
        // var_dump($this->name);
        // var_dump($this->data);
    }

    public function renderView()
    {
        $data = $this->data;

        if (file_exists("app/" . $this->name . ".php")) {
            include("app/" . $this->name . ".php");
        } else {
            die("An error has occurred, contact the support");
        }
    }

}