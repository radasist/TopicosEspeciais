<?php

error_reporting(0);

require_once("conexao.php");

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
            <li>Saldo</li>
            <li>Movimentos</li>
        </ul>
        <h3>Registro</h3>
        <ul>
            <li>Abastecimento</li>
        </ul>
        <h3>Cadastros/Consultas</h3>
        <ul>
            <li page="consultaCliente">Clientes</li>
            <li>Estabelecimentos</li>
            <li>Grupos de estabelecimentos</li>
            <li>Produtos</li>
        </ul>
        <h3>Sistema</h3>
        <ul>
            <li>Configurações</li>
        </ul>
    </div>

    <div class="principal-container">
        
    </div>

    <div class="confirm-outer">
        <div class="confirm-container">
            <div class="confirm-message">Tem certeza que deseja excluir "Fulado de Tal"?</div>
            <div class="confirm-buttons">
                <span class="confirm-yes">Sim</span>
                <span class="confirm-no">Não</span>
            </div>
        </div>
    </div>

    <div class="progress-bar"></div>

    <div class="message-bar">
        <div class="message-bar-message">Mensagem de teste!</div>
        <div class="message-bar-close">Fechar</div>
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