<?php
use Adm\Models\Encryption;

$encryption = new Encryption;
$dataUser = (isset($data['data'])) ? $data['data'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vale da Tecnologia</title>
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>table.css" />
  <link rel="shortcut icon" href="<?php echo IMG_PATH ?>iconsite.ico" type="image/x-icon" />
</head>

<body class="<?php echo (isset($_COOKIE['theme'])) ? $_COOKIE['theme'] . "-theme" : "" ?>">
  <!-- Header fixed -->
  <header class="header">
    <div class="nav-bar">
      <div class="nav-btn">
        <button type="button" class="nav-bar nav-menu sidebar-btn">
          <i id="nav-menu-icon" class="nav-bar nav-menu" data-feather="menu"></i>
        </button>
      </div>
      <div class="logo">
        <a href="/" id="logo"><img id="logo" src="<?php echo IMG_PATH ?>Logo.png" alt="Vale da Tecnologia" /></a>
      </div>
    </div>
    <div class="perfil">
      <div class="icon-perfil">
        <img src="<?php echo IMG_PATH ?>users/icon-perfil.png" alt="icon-perfil" />
      </div>
      <!-- <div class="name-perfil">
            <p>Name-perfil</p>
          </div> -->
      <div class="dropdown-perfil">
        <li>
          <a href=" <?php echo DEFAULT_URL ?>config/">Configuração<i data-feather="settings"
              class="settings-icon"></i></a>
        </li>
        <li>
          <a href="<?php echo DEFAULT_URL ?>home/logout">Sair<i data-feather="log-out" class="log-out-icon"></i></a>
        </li>
      </div>
    </div>
  </header>
  <!-- header end -->

  </div>
  <!-- Wrapper -->
  <div class="wrapper">
    <!-- sidebar -->
    <div class="sidebar">
      <a href="<?php echo DEFAULT_URL ?>" title="Dashboard">
        <i data-feather="home"></i>
        <p>Dashboard</p>
      </a>
      <a href="<?php echo DEFAULT_URL ?>relatorio/" title="Relatório">
        <i data-feather="clipboard"></i>
        <p>Relatório</p>
      </a>
      <button class="sidebar-dropdown users" title="Usuários">
        <i data-feather="users"></i>
        <div>
          <p>Usuários</p>
          <i data-feather="chevron-up" class="dropdown-icon users-icon"></i>
        </div>
      </button>
      <a href="<?php echo DEFAULT_URL ?>usuarios/listar" class="users-pages"
        style="display: flex; background-color: var(--forth-color);" title="Listar">
        <i data-feather="list"></i>
        <p>Listar</p>
      </a>
      <a href="<?php echo DEFAULT_URL ?>usuarios/cadastrar" class="users-pages" style="display: flex;"
        title="Cadastrar">
        <i data-feather="user-plus" class="form-icon"></i>
        <p>Cadastrar</p>
      </a>
      <button class="sidebar-dropdown systems" title="Sistemas">
        <i data-feather="monitor"></i>
        <div>
          <p>Sistemas</p>
          <i data-feather="chevron-down" class="dropdown-icon systems-icon"></i>
        </div>
      </button>
      <a href="<?php echo DEFAULT_URL ?>sistemas/listar" title="Sistemas" class="systems-pages">
        <i data-feather="list"></i>
        <p>Listar</p>
      </a>
      <a href="<?php echo DEFAULT_URL ?>sistemas/cadastrar" title="Sistemas" class="systems-pages">
        <i data-feather="file-plus"></i>
        <p>Cadastrar</p>
      </a>
      <a href="<?php echo DEFAULT_URL ?>home/logout" title="Sair">
        <i data-feather="log-out"></i>
        <p>Sair</p>
      </a>
    </div>
    <!-- Sidebar End -->

    <!-- Main Content -->
    <div class="content">
      <div class="users-section list-users">
        <!-- Users Top -->
        <div class="top">
          <div class="title">Listar</div>
          <div class="btn">
            <a href="<?php echo DEFAULT_URL ?>usuarios/cadastrar" class="btn-register" title="Cadastrar">
              <i data-feather="user-plus"></i>
              <p>Cadastrar</p>
            </a>
          </div>
        </div>
        <!-- Users Top End -->

        <div class="options">
          <form action="" method="get" class="form">
            <div class="dropdown typeUser">
              <button type="button" class="select-btn">
                <input type="text" name="type" id="tipo" class="value" placeholder="Selecione o tipo de Formulario"
                  readonly value="<?php echo (isset($data['type']) ? ucfirst($data['type']) : "Clientes") ?>">
                <span class="arrow"></span>
              </button>
              <ul>
                <li>Clientes</li>
                <li>Contadores</li>
              </ul>
            </div>
            <div class="dropdown situacao">
              <button type="button" class="select-btn">
                <input type="text" class="value" name="situacao" id="situacao"
                  value="<?php echo (isset($data['situacao']) ? $data['situacao'] : "Ativos") ?>" readonly>

                <span class="arrow"></span>
              </button>
              <ul>
                <li>Todos</li>
                <li>Ativos</li>
                <li>Inativos</li>
              </ul>
            </div>
            <div class="multi-select columns">
              <input type="text" class="columnArray" name="columns" id="columnArray">
              <span class="textBox">
                <p>Selecione as Colunas a Exibir</p>
              </span>
              <span class="arrow"></span>
              <span class="selectBox">
                <ul>
                  <?php
                  foreach ($data['allColumns'] as $key => $value) {
                    $class = (in_array($value, $data['selectedColumns'])) ? "active" : "";

                    echo "<li class=\"{$class}\">{$value}</li>";
                  }
                  ?>
                </ul>
              </span>
            </div>
            <div class="search">
              <input type="text" name="search" id="search" class="search-input" placeholder="Pesquisar"
                value="<?php echo (isset($data['search']) ? $data['search'] : "") ?>">
              <input type="submit" value="Buscar">
              <div class="dropdown search-column">
                <button type="button" class="select-btn">
                  <input type="text" name="selectColumn" class="value" id="selectColumn" readonly
                    value="<?php echo (isset($data['selectColumn']) ? $data['selectColumn'] : "NOME") ?>">

                  <span class="arrow"></span>
                </button>
                <ul>
                  <li>NOME</li>
                  <li>RAZAO</li>
                  <li>CNPJ</li>
                  <li>EMAIL</li>
                  <li>COD_PES</li>
                  <li>SPED</li>
                </ul>
              </div>
            </div>
          </form>
        </div>

        <!-- Users Options -->

        <!-- Users Options  End -->

        <!-- Table -->
        <div class="table">
          <table class="table-content">
            <thead>
              <tr>
                <th class="list-head-content">ID</th>
                <th class="list-head-content">NOME</th>
                <?php
                if ($data['type'] == "Contadores") {
                  echo "<th class=\"list-head-content\">SENHA</th>";
                }
                foreach ($data['selectedColumns'] as $key => $value) {
                  echo "<th class=\"list-head-content\">{$value}</th>";
                }
                ?>
                <th class="list-head-content">Ações</th>
              </tr>
            </thead>
            <tbody>

              <?php

              foreach ($dataUser as $key => $person) {
                $password = (in_array($data['type'], ["cliente", "Cliente", ""])) ? ((!empty($person['SENHA_BACKUP'])) ? $person['SENHA_BACKUP'] : $person['SENHA_BACKUP']) : ((!empty($person['senha_contador'])) ? $encryption->decrypt($person['senha_contador']) : $person['senha_contador']);
                echo "<tr class=\"list-body-line\">";
                foreach ($person as $key => $value) {
                  switch ($key) {
                    case 'EMAIL':
                      if (!empty($value)) {
                        echo "<td class=\"list-body-content email\"><div class=\"email\"><p>{$value}</p><button type=\"button\" class=\"copy-email\"><i class=\"icon\" data-feather=\"clipboard\"></i></button></div></td>";
                      } else {
                        echo "<td class=\"list-body-content\"></td>";
                      }
                      break;

                    case "senha_contador":
                      if (!empty($value)) {
                        echo "<td class=\"list-body-content\"><div class=\"pass\"><p>********</p><input type=\"text\" value=\"{$password}\" name=\"passwd\" readonly\><button type=\"button\" class=\"copy-pass\"><i class=\"icon\" data-feather=\"clipboard\"></i></button></div></td>";
                      } else {
                        echo "<td class=\"list-body-content\"></td>";
                      }
                      break;

                    case "SENHA_BACKUP":
                      if (!empty($value)) {
                        echo "<td class=\"list-body-content\"><div class=\"pass\"><p>********</p><input type=\"text\" value=\"{$password}\" name=\"passwd\" readonly\><button type=\"button\" class=\"copy-pass\"><i class=\"icon\" data-feather=\"clipboard\"></i></button></div></td>";
                      } else {
                        echo "<td class=\"list-body-content\"></td>";
                      }
                      break;

                    default:
                      echo "<td class=\"list-body-content\">" . mb_convert_case($value, MB_CASE_TITLE, "UTF-8") . "</td>";
                      break;
                  }
                }
                echo "<td class=\"list-body-content\">
                      <div class=\"list-body-buttons\">
                        <a href=\"" . DEFAULT_URL . "usuarios/visualizar?id={$person['COD_PES']}&type={$data['type']}\" id=\"show\" title=\"Vizualizar\">
                          <i data-feather=\"eye\"></i>
                        </a>
                        <a href=\"" . DEFAULT_URL . "usuarios/editar?id={$person['COD_PES']}&type={$data['type']}\" id=\"edit\" title=\"Editar\">
                          <i data-feather=\"edit\"></i>
                        </a>
                        <button class=\"delete\" id=\"delete\" title=\"Apagar\">
                          <i data-feather=\"trash\"></i>
                        </button>
                      </div>
                    </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- Table End -->

        <div class="content-none">
          <?php
          if (empty($dataUser)) {
            echo "<i data-feather=\"users\" class=\"content-none-icon\"></i>";
            echo "<p class=\"\">Nenhum usuário cadastrado!</p>";
          }
          ?>
        </div>

        <?php

        $data['type'] = (!isset($data['type'])) ? 'Clientes' : $data['type'];
        $data['situacao'] = (!isset($data['situacao'])) ? 'Ativos' : $data['situacao'];
        $data['search'] = (!isset($data['search'])) ? '' : $data['search'];
        $data['selectColumn'] = (!isset($data['selectColumn'])) ? 'NOME' : $data['selectColumn'];

        ?>

        <!-- Pagination -->
        <div class="content-pagination">
          <div class="pages">
            <a
              href="?page=1&type=<?php echo $data['type'] ?>&situacao=<?php echo $data['situacao'] ?>&search=<?php echo $data['search'] ?>&selectColumn=<?php echo $data['selectColumn'] ?>">&laquo;</a>
            <?php
            $currentPage = isset($data['page']) ? $data['page'] : 1;

            if ($currentPage > 1) {
              echo "<a href=\"?page=" . ($currentPage - 1) . "&type={$data['type']}&situacao={$data['situacao']}&search={$data['search']}&selectColumn={$data['selectColumn']}\">&lsaquo;</a>";
            }

            $startPage = 1;
            $endPage = $data['page-limit'];

            for ($i = $startPage; $i <= $endPage; $i++) {
              if ($i == $currentPage) {
                echo "<a href=\"?page={$i}&type={$data['type']}&situacao={$data['situacao']}&search={$data['search']}&selectColumn={$data['selectColumn']}\" style=\"font-weight:600;\">" . sprintf('%02d', $i) . "</a>";
              } else {
                echo "<a href=\"?page={$i}&type={$data['type']}&situacao={$data['situacao']}&search={$data['search']}&selectColumn={$data['selectColumn']}\">" . sprintf('%02d', $i) . "</a>";
              }
            }

            if ($currentPage < $data['page-limit']) {
              echo "<a href=\"?page=" . ($currentPage + 1) . "&type={$data['type']}&situacao={$data['situacao']}&search={$data['search']}&selectColumn={$data['selectColumn']}\">&rsaquo;</a>";
            }
            ?>
            <a
              href="?page=<?php echo $data['page-limit'] ?>&type=<?php echo $data['type'] ?>&situacao=<?php echo $data['situacao'] ?>&search=<?php echo $data['search'] ?>&selectColumn=<?php echo $data['selectColumn'] ?>">&raquo;</a>
          </div>
        </div>
        <!-- Pagination End -->
      </div>
    </div>
    <!-- Main Content End -->
  </div>
  <!-- Wrapper End -->

  <!-- Pop Up -->
  <div class="popUp" hidden>
    <div class="popUp-content">
      <span class="popUp-close">&times;</span>
      <h2 class="popUp-title"></h2>
      <p class="popUp-text"></p>
      <button class="popUp-btn" id="delete">
        <i data-feather="trash"></i>
      </button>
    </div>
  </div>
  <!-- Pop Up End -->

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
  <script src="<?php echo JS_PATH ?>dropdown.js"></script>
  <script src="<?php echo JS_PATH ?>copy.js"></script>
  <script src="<?php echo JS_PATH ?>multi-select.js"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>