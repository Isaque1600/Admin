<?php

namespace Adm\Controllers;

use Adm\Models\Dashboard;
use Adm\Models\Helpers\AdmSelect;
use Core\ConfigView;
use PDOException;

class Home
{
    protected array $data = [];

    public function index()
    {
        $select = new AdmSelect();
        $systems = new Dashboard();
        try {

            $theme = $select->select('THEME', $_SESSION['user']);

            if (!empty($theme)) {
                setcookie('theme', $theme['theme'], 0, '/');
            }

            $this->data['systems']['TEF'] = $systems->selectSyst('TEF', 'sim')['soma'];
            $this->data['systems']['GDPRO'] = $systems->selectSyst('SYSTEM', 'Gdoor Pro')['soma'];
            $this->data['systems']['GDSLIM'] = $systems->selectSyst('SYSTEM', 'Gdoor Slim')['soma'];
            $this->data['systems']['GDMICRO'] = $systems->selectSyst('SYSTEM', 'Gdoor Micro')['soma'];
            $this->data['persons']['clientes'] = $systems->selectPersons('cliente')['soma'];
            $this->data['persons']['contadores'] = $systems->selectPersons('contador')['soma'];
        } catch (PDOException $err) {
            return $err;
        }

        $loadView = new ConfigView("adm/Views/dashboard/dashboard", $this->data);
        $loadView->renderView();

    }

    public function logout()
    {
        header("location: ../../zyro/ajax/logout.php");
    }

}
