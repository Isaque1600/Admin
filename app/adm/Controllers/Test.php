<?php

namespace Adm\Controllers;

use Adm\Models\Encryption;
use Adm\Models\Helpers\AdmUpdate;
use Core\ConfigView;

// use Adm

class Test
{

    private ?array $data = [];

    public function index()
    {
        $enc = new Encryption;

        // $enc->decrypt("");

        $loadView = new ConfigView("adm/Views/test", $this->data);
        $loadView->renderView();
    }

}