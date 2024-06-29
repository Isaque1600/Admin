<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vale da Tecnologia</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" />
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>dashboard.css" />
    <link rel="shortcut icon" href="<?php echo IMG_PATH ?>iconsite.ico" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo JS_PATH ?>ThemeSetter.js"></script>
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
                <a href="/" id="logo"><img id="logo" src="<?php echo IMG_PATH ?>Logo.png"
                        alt="Vale da Tecnologia" /></a>
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
                    <a href="<?php echo DEFAULT_URL ?>config/">Configuração<i data-feather="settings"
                            class="settings-icon"></i></a>
                </li>
                <li>
                    <a href="<?php echo DEFAULT_URL ?>home/logout">Sair<i data-feather="log-out"
                            class="log-out-icon"></i></a>
                </li>
            </div>
        </div>
    </header>

    <!-- header end -->

    <!-- sidebar -->
    <div class="wrapper">
        <div class="sidebar">
            <a href="<?php echo DEFAULT_URL ?>" style="display: flex; background-color: var(--forth-color);"
                title="Dashboard">
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
        <div class="content">
            <div class="dashboard-section">
                <div class="top">
                    Sistemas
                </div>
                <div class="sistemas">
                    <div class="box bg-amber-500">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['systems']['GDPRO'] ?>
                        </p>
                        <p>Gdoor Pro</p>
                    </div>
                    <div class="box bg-green-500">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['systems']['GDSLIM'] ?>
                        </p>
                        <p>Gdoor Slim</p>
                    </div>
                    <div class="box bg-blue-600">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['systems']['GDMICRO'] ?>
                        </p>
                        <p>Gdoor Micro</p>
                    </div>
                    <div class="box bg-red-700">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['systems']['TEF'] ?>
                        </p>
                        <p>TEF</p>
                    </div>
                </div>
            </div>
            <div class="dashboard-section">
                <div class="top">
                    <p>Usuários</p>
                </div>
                <div class="pessoas">
                    <div class="box bg-indigo-500">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['persons']['clientes'] ?>
                        </p>
                        <p>Clientes</p>
                    </div>
                    <div class="box bg-cyan-500">
                        <i data-feather="monitor"></i>
                        <p>
                            <?php echo $data['persons']['contadores'] ?>
                        </p>
                        <p>Contadores</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sidebar end -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>ThemeSetter.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>