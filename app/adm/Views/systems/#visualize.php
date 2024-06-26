<?php

$dataSystem = (isset($data['data'])) ? $data['data'] : $dataSystem;

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

<body>
    <!-- Header fixed -->
    <header class="header">
        <div class="nav-bar">
            <div class="nav-btn">
                <button type="button" class="nav-bar nav-menu sidebar-btn">
                    <i id="nav-menu-icon" class="nav-bar nav-menu" data-feather="menu"></i>
                </button>
            </div>
            <div class="logo">
                <a href="/" id="logo"><img id="logo" src="<?php echo IMG_PATH ?>Logo.png"
                        alt="Vale da Tecnologia" /></a>
            </div>
        </div>
        <div class="perfil">
            <div class="icon-perfil">
                <img src="<?php echo IMG_PATH ?>users/icon-perfil.png" alt="icon-perfil" />
            </div>
            <div class="dropdown-perfil">
                <li>
                    <a href="">Configuração<i data-feather="settings" class="settings-icon"></i></a>
                </li>
                <li>
                    <a href="<?php echo DEFAULT_URL ?>home/logout">Sair<i data-feather="log-out"
                            class="log-out-icon"></i></a>
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
                    <i data-feather="chevron-down" class="dropdown-icon users-icon"></i>
                </div>
            </button>
            <a href="<?php echo DEFAULT_URL ?>usuarios/listar" class="users-pages" title="Listar">
                <i data-feather="list"></i>
                <p>Listar</p>
            </a>
            <a href="<?php echo DEFAULT_URL ?>usuarios/cadastrar" class="users-pages" title="Cadastrar">
                <i data-feather="user-plus" class="form-icon"></i>
                <p>Cadastrar</p>
            </a>
            <button class="sidebar-dropdown systems" style="border-left: 4px var(--third-color) solid;"
                title="Sistemas">
                <i data-feather="monitor"></i>
                <div>
                    <p>Sistemas</p>
                    <i data-feather="chevron-up" class="dropdown-icon systems-icon"></i>
                </div>
            </button>
            <a href="<?php echo DEFAULT_URL ?>sistemas/listar" title="Sistemas"
                style="display: flex; background-color: var(--forth-color);" class="systems-pages">
                <i data-feather="list"></i>
                <p>Listar</p>
            </a>
            <a href="<?php echo DEFAULT_URL ?>sistemas/cadastrar" style="display: flex;" title="Sistemas"
                class="systems-pages">
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
                        <button type="button" class="btn-register" title="Cadastrar">
                            <i data-feather="user-plus"></i>
                            <p>Cadastrar</p>
                        </button>
                    </div>
                </div>
                <!-- Users Top End -->

                <!-- Table -->
                <table class="table-content">
                    <thead>
                        <tr>
                            <th class="list-head-content">ID</th>
                            <th class="list-head-content">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo "<tr class=\"list-body-line\">";
                        echo "<td class=\"list-body-content\">{$dataSystem['id']}</td>";
                        echo "<td class=\"list-body-content\">{$dataSystem['nome']}</td>";
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
                <!-- Table End -->

            </div>
        </div>
        <!-- Main Content End -->
    </div>
    <!-- Wrapper End -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>