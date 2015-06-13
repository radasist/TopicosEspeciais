<?php

error_reporting(0);

session_start();
session_unset();
require("conexao.php");

$showError = "";
$email = "";
$senha = "";

if ($_POST["enviado"]) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $data = $sqlConn->query("SELECT id FROM usuarios WHERE LOWER(email) = LOWER('".$_POST["email"]."') AND LOWER(senha) = LOWER('".md5($_POST["senha"])."')");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);
    
    if (count($resultArray) > 0) {
        $_SESSION["idUsuario"] = $resultArray[0]["id"];
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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimun-scale=1, maximum-scale=1">
    <title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">

<body>
    <div class="bar-top">
        <div class="logo"><img src="LancerCB0.png"></div>
        <div class="text">
            <h1>Sistema Seus Pontos</h1>
            <h2>Para você ir mais longe</h2>
        </div>
    </div>

    <div class="content-index">
        <h1>Sistema de pontuação</h1>
        <p><strong>Indique seus amigos</strong>, eles abastecem e fazem compras e você <strong>ganha bônus</strong>!</p>
    </div>

    <div class="content-login <?=$showError?>">
        <h3>Login</h3>
        <form method="post" action="index.php">
            <input type="hidden" name="enviado" value="1">
            <input type="text" name="email" placeholder="email" value="<?=$email?>" required autofocus>
            <input type="password" name="senha" placeholder="senha" value="<?=$senha?>" required>
            <input type="submit" value="Login">
        </form>
        <div class="error">Email e/ou senha incorretos!</div>
    </div>
    
    <div class="content-index">
        <p><a href="cadastrase.php">Faça já seu cadastro!</a></p>
    </div>
</body>

</html>