<?php

namespace Adm\Controllers;

use Adm\Models\Helpers\AdmInsert;
use Adm\Models\Helpers\AdmUpdate;
use Core\ConfigView;
use PDOException;

class config
{

    protected ?array $data = [];

    public function index()
    {
        $loadView = new ConfigView('adm/Views/config/config', $this->data);
        $loadView->renderView();
    }

    public function mudarTema(?array $urlParameters = null)
    {
        $insert = new AdmInsert();
        $update = new AdmUpdate();

        try {

            if (isset($urlParameters['theme'])) {

                if (in_array($urlParameters['theme'], ['dark', 'light'])) {
                    setcookie('theme', $urlParameters['theme'], 0, "/");

                    $insert->insert('THEME', ['personId' => $_SESSION['user'], 'theme' => $urlParameters['theme']]);

                    header('location:' . DEFAULT_URL . "config/");
                }

                header('location:' . DEFAULT_URL . "config/temaPersonalizado");

            }

        } catch (PDOException $err) {

            if ($err->getCode() == "23000") {

                try {

                    $update->update(['personId' => (int) $_SESSION['user'], 'theme' => $urlParameters['theme']], 'THEME');

                    header('location:' . DEFAULT_URL . "config/");

                } catch (PDOException $err) {

                    $this->data['err'] = $err->getMessage();

                }
            }

            $this->data['err']['message'] = $err->getMessage();
        }

        var_dump($this->data);

    }

}
