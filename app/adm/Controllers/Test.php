<?php

namespace Adm\Controllers;

use Adm\Models\Encryption;
use Adm\Models\Helpers\AdmSelect;
use Adm\Models\Helpers\AdmUpdate;
use Core\ConfigView;

// use Adm

class Test
{

    private ?array $data = [];

    public function index()
    {
        $enc = new Encryption;
        $select = new AdmSelect();
        $update = new AdmUpdate;

        $users = $select->selectAll('PESSOAS');

        foreach ($users as $key => $value) {
            if ($value['SENHA_BACKUP'] != NULL && count($value['SENHA_BACKUP']) < 172) {
                $update->update(['COD_PES' => $value['COD_PES'], 'SENHA_BACKUP' => $enc->encrypt($value['SENHA_BACKUP'])], 'PESSOAS');
            }
        }

        // $users = $select->selectAll('PESSOAS');

    }

}