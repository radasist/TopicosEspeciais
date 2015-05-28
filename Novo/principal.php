<?php

error_reporting(0);

require("conexao.php");

$showError = "";
$usuario = "";

if ($_POST["enviado"]) {
    $usuario = $_POST["usuario"];

    $data = $sqlConn->query("SELECT 1 FROM usuarios WHERE usuario = '".$_POST["usuario"]."' AND senha = '".$_POST["senha"]."'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    if ($resultArray[0][1]) {
        header('Location: principal.php');
        die();
    } else {
        $showError = "show-error";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">

<script src="jquery-2.1.4.js"></script>

<body class="main-page">
    <div class="bar-top">
        <div class="menu-button"><div class="menu-button-inner"></div></div>
        <div class="logo"><img src="LancerCB0.png"></div>
        <div class="text">
            <h1>Sistema Seus Pontos</h1>
            <h2>Para você ir mais longe</h2>
        </div>
    </div>

    <div class="menu-container">
        <h1>Menu</h1>
        <h3>Consultas</h3>
        <ul>
            <li><a href="consultaSaldo.php" target="principal-iframe">Saldo</a></li>
            <li><a href="consultaMovimentos.php" target="principal-iframe">Movimentos</a></li>
        </ul>
        <h3>Registro</h3>
        <ul>
            <li><a href="abastecer.php" target="principal-iframe">Abastecimento</a></li>
        </ul>
        <h3>Cadastros/Consultas</h3>
        <ul>
            <li><a href="consultaCliente.php" target="principal-iframe">Clientes</a></li>
            <li><a href="cadastroEstabelecimento.php" target="principal-iframe">Estabelecimentos</a></li>
            <li><a href="cadastroGrupo.php" target="principal-iframe">Grupos de estabelecimentos</a></li>
            <li><a href="cadastroProduto.php" target="principal-iframe">Produtos</a></li>
        </ul>
        <h3>Sistema</h3>
        <ul>
            <li><a href="configuracoes.php" target="principal-iframe">Configurações</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Sistema de pontuação</h1>
        <p><strong>Indique seus amigos</strong>, e <strong>ganhe bônus</strong> com o abastecimento do carro deles! (depois a gente muda)</p>
    </div>

    <div class="content-login">
        <h3>Login</h3>
        <form method="post" action="index.php">
            <input type="hidden" name="enviado" value="1">
            <input type="text" name="usuario" placeholder="usuário" value="<?=$usuario?>" required autofocus>
            <input type="password" name="senha" placeholder="senha" required>
            <input type="submit" value="Login">
        </form>
    </div>
    
    <div class="content">
        <p><a href="cadastrase.php">Faça já seu cadastro!</a></p>
    </div>
    <!-- <div class="login-container <?=$showError?>">
        <h1>Login</h1>
        <form method="post" action="index.php">
            <input type="hidden" name="enviado" value="1">
            <input type="text" name="usuario" placeholder="usuário" value="<?=$usuario?>" required autofocus>
            <input type="password" name="senha" placeholder="senha" required>
            <input type="submit" value="Login">
        </form>
        <div class="error">Usuário e/ou senha incorretos!</div>
    </div> -->
</body>

<script src="meusscripts.js"></script>

</html>