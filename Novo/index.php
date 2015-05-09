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
    <title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">

<body>
    <div class="content-login">
        <h1>Sistema de pontuação</h1>
        <p><strong>Indique seus amigos</strong>, e <strong>ganhe bônus</strong> com o abastecimento do carro deles! (depois a gente muda)</p>
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

</html>