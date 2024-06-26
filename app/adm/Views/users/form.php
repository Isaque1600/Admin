<?php

$dataForm = (isset($data['form'])) ? $data['form'] : null;
$systems = $data['systs'];
$accountants = $data['accountants'];
// var_dump($data);

if (isset($data['result'])) {
  if ($data['result'] == "succeed") {
    $result['title'] = "Cadastro realizado com sucesso!";
    $result['text'] = "O cadastro do usuário: {$dataForm['name']}, foi realizado com sucesso!";
  } elseif ($data['result'] == "23000") {
    $result['title'] = "Usuário já cadastrado no sistema!";
    $result['text'] = "O usuário {$dataForm['name']} já está cadastrado no sistema\nTente cadastrar outro usuário";
  } else {
    $result['title'] = "Error inesperado!";
    $result['text'] = "Um erro inesperado ocorreu\nCódigo do erro:{$data['result']}\nAnote o código do erro e contate o desenvolvedor!";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vale da Tecnologia</title>
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>form.css" />
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
        <a href="<?php echo DEFAULT_URL ?>" id="logo"><img id="logo" src="<?php echo IMG_PATH ?>Logo.png"
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
      <a href="<?php echo DEFAULT_URL ?>usuarios/listar" class="users-pages" style="display: flex;" title="Listar">
        <i data-feather="list"></i>
        <p>Listar</p>
      </a>
      <a href="<?php echo DEFAULT_URL ?>usuarios/cadastrar" class="users-pages"
        style="display: flex; background-color: var(--forth-color);" title="Cadastrar">
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
      <div class="form-section">
        <!-- Form Top -->
        <div class="top">
          <div class="title">Formulário</div>
        </div>
        <!-- Form Top End -->
        <div class="form-register">
          <form action="" method="post" class="form">
            <div class="section">
              <div class="row all">
                <div class="select dropdown-type">
                  <input type="text" name="type" id="type" class="input-text type"
                    placeholder="Selecione o tipo de Formulario" readonly
                    value="<?php echo $dataForm['type'] = (isset($dataForm['type'])) ? ucfirst($dataForm['type']) : "Cliente" ?>">
                  <ul class="options">
                    <li class="option">Cliente</li>
                    <li class="option">Contador</li>
                  </ul>
                </div>
              </div>
              <div class="row all">
                <input type="text" name="name" id="name" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['name'] = (isset($dataForm['name']) && !isset($data['result'])) ? $dataForm['name'] : "" ?>"
                  required>
                <label for="name" class="text-label">Nome Fantasia:</label>
              </div>
              <div class="row cliente">
                <input type="text" name="contato" id="contato" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['contato'] = (isset($dataForm['contato'])) ? $dataForm['contato'] : "" ?>">
                <label class="text-label" for="contato">Contato:</label>
              </div>
              <div class="row all">
                <input type="text" name="razao" id="razao" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['razao'] = (isset($dataForm['razao'])) ? $dataForm['razao'] : "" ?>">
                <label for="razao" class="text-label">Razão:</label>
              </div>
              <div class="row all">
                <input type="text" name="cnpj" id="cnpj" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['cnpj'] = (isset($dataForm['cnpj'])) ? $dataForm['cnpj'] : "" ?>">
                <label for=" cnpj" class="text-label">CNPJ:</label>
              </div>
              <div class="row all">
                <input type="text" name="ie" id="ie" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['ie'] = (isset($dataForm['ie'])) ? $dataForm['ie'] : "" ?>">
                <label class="text-label" for="ie">Inscrição Estadual:</label>
              </div>
              <div class="row all">
                <input type="text" name="logradouro" id="logradouro" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['logradouro'] = (isset($dataForm['logradouro'])) ? $dataForm['logradouro'] : "" ?>">
                <label for="logradouro" class="text-label">Logradouro:</label>
              </div>
              <div class="row all">
                <input type="text" name="numero" id="numero" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['numero'] = (isset($dataForm['numero'])) ? $dataForm['numero'] : "" ?>">
                <label for="numero" class="text-label">Número:</label>
              </div>
              <div class="row all">
                <input type="text" name="bairro" id="bairro" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['bairro'] = (isset($dataForm['bairro'])) ? $dataForm['bairro'] : "" ?>">
                <label class="text-label" for="bairro">Bairro:</label>
              </div>
              <div class="row all">
                <input type="text" name="cidade" id="cidade" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['cidade'] = (isset($dataForm['cidade'])) ? $dataForm['cidade'] : "" ?>">
                <label class="text-label" for="cidade">Cidade:</label>
              </div>
              <div class="row all">
                <input type="text" name="cep" id="cep" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['cep'] = (isset($dataForm['cep'])) ? $dataForm['cep'] : "" ?>">
                <label class="text-label" for="cep">CEP:</label>
              </div>
              <div class="row all">
                <input type="text" name="uf" id="uf" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['uf'] = (isset($dataForm['uf'])) ? $dataForm['uf'] : "" ?>">
                <label class="text-label" for="uf">UF:</label>
              </div>
              <div class="row all">
                <input type="text" name="email" id="email" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['email'] = (isset($dataForm['email'])) ? $dataForm['email'] : "" ?>">
                <label for="email" class="text-label">E-mail:</label>
              </div>
              <div class="row cliente">
                <input type="text" name="email_backup" id="email_backup" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['email_backup'] = (isset($dataForm['email_backup'])) ? $dataForm['email_backup'] : "" ?>">
                <label for="email_backup" class="text-label">E-mail de Backup:</label>
              </div>
              <div class="row contador" hidden>
                <input type="text" name="senha" id="senha" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['senha'] = (isset($dataForm['senha'])) ? $dataForm['senha'] : "" ?>">
                <label for="senha" class="text-label">Senha:</label>
              </div>
              <div class="row contador">
                <input type="text" name="senha_backup" id="senha_backup" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['senha_backup'] = (isset($dataForm['senha_backup'])) ? $dataForm['senha_backup'] : "" ?>">
                <label for="senha_backup" class="text-label">Senha de Backup:</label>
              </div>
              <div class="row cliente">
                <div class="select dropdown-contador">
                  <input type="text" name="contador" id="contador" class="input-text contador-box"
                    placeholder="Selecione o contador"
                    value="<?php echo $dataForm['contador'] = (isset($dataForm['contador'])) ? $dataForm['contador'] : "" ?>"
                    readonly />
                  <ul class="options">
                    <li class="option none">Nenhum</li>
                    <?php

                    foreach ($accountants as $key => $value) {
                      echo "<li class=\"option\">{$value['NOME']}</li>";
                    }

                    ?>
                  </ul>
                </div>
              </div>
              <div class="row cliente">
                <div class="select dropdown-sistema">
                  <input type="text" name="sistema" id="sistema" class="input-text sistema"
                    placeholder="Selecione o sistema"
                    value="<?php echo $dataForm['sistema'] = (isset($dataForm['sistema'])) ? $dataForm['sistema'] : "" ?>"
                    readonly />
                  <ul class="options">
                    <li class="option none">Nenhum</li>
                    <?php

                    foreach ($systems as $key => $value) {
                      echo "<li class=\"option\">{$value['nome']}</li>";
                    }

                    ?>
                  </ul>
                </div>
              </div>
              <div class="row serial">
                <input type="text" name="serial" id="serial" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['serial'] = (isset($dataForm['serial'])) ? $dataForm['serial'] : "" ?>">
                <label class="text-label" for="serial">Serial:</label>
              </div>
              <div class="row all">
                <div class="title-checkbox">
                  <label for="situacao" class="label situacao">Ativo:</label>
                </div>
                <div class="button r" id="button-9">
                  <input type="checkbox" name="situacao" id="situacao" class="checkbox" value="Ativo" <?php echo $dataForm['situacao'] = (isset($dataForm['situacao']) and !empty($dataForm['situacao'])) ? "checked" : "" ?> />
                  <div class="knobs">
                    <span></span>
                  </div>
                  <div class="layer"></div>
                </div>
              </div>
              <div class="row cliente">
                <div class="title-checkbox">
                  <label for="tef" class="label tef">TEF:</label>
                </div>
                <div class="button r" id="button-9">
                  <input type="checkbox" name="tef" id="tef" class="checkbox" value="Sim" <?php echo $dataForm['tef'] = (isset($dataForm['tef']) and !empty($dataForm['tef'])) ? "checked" : "" ?> />
                  <div class="knobs">
                    <span></span>
                  </div>
                  <div class="layer"></div>
                </div>
              </div>
              <div class="row cliente">
                <div class="title-checkbox">
                  <label for="nfe" class="label nfe">NFE:</label>
                </div>
                <div class="button r" id="button-9">
                  <input type="checkbox" name="nfe" id="nfe" class="checkbox" value="Sim" <?php echo $dataForm['nfe'] = (isset($dataForm['nfe']) and !empty($dataForm['nfe'])) ? "checked" : "" ?> />
                  <div class="knobs">
                    <span></span>
                  </div>
                  <div class="layer"></div>
                </div>
              </div>
              <div class="row cliente">
                <div class="title-checkbox sped">
                  <label for="nfce" class="label sped">SPED:</label>
                </div>
                <div class="button r" id="button-9">
                  <input type="checkbox" name="sped" id="sped" class="checkbox" value="Sim" <?php echo $dataForm['sped'] = (isset($dataForm['sped']) and !empty($dataForm['sped'])) ? "checked" : "" ?> />
                  <div class="knobs">
                    <span></span>
                  </div>
                  <div class="layer"></div>
                </div>
              </div>
              <div class="row ven_cert">
                <input type="text" name="ven_cert" id="ven_cert" class="input-text" placeholder=' '
                  value="<?php echo $dataForm['ven_cert'] = (isset($dataForm['ven_cert'])) ? $dataForm['ven_cert'] : "" ?>">
                <label class="text-label" for="ven_cert">Vencimento do Certificado:</label>
              </div>
              <div class="row cliente obs">
                <label for="obs">Observação:</label>
                <textarea name="obs" id="obs" cols="30" rows="10" value="hello"></textarea>
              </div>
              <div class="row submit">
                <button type="submit" name="submit" value="registerUser" class="submitBtn"><i
                    data-feather="user-plus"></i>
                  <p>Cadastrar</p>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Main Content End -->
  </div>
  <!-- Wrapper End -->

  <!-- Pop Up -->
  <div class="popUp" style="<?php
  echo (isset($data['result'])) ? "display: flex;" : "display: none;";
  ?>">
    <div class="popUp-content">
      <span class="popUp-close">&times;</span>
      <h2 class="popUp-title">
        <?php echo $result['title']; ?>
      </h2>
      <p class="popUp-text">
        <?php echo $result['text']; ?>
      </p>
    </div>
  </div>
  <!-- Pop Up End -->

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.js"></script>
  <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
  <script type="text/javascript" src="<?php echo JS_PATH ?>InputFormat.js"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>