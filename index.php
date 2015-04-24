<?php

error_reporting(0);

// if ($_POST['username'] == "admin" && $_POST['password'] == "admin") {
//     header("location:cadastro.php");
//     die();
// } else if (trim($_POST['username']) && trim($_POST['password'])) {
//     echo "usuário e/ou senha incorretos<br>";
// }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">

<body>
    <div class="login-container show-error">
        <h1>Login</h1>
        <form method="post" action="index.php">
            <input type="hidden" name="enviado" value="1">
            <input type="text" name="username" placeholder="usuário" required autofocus>
            <input type="password" name="password" placeholder="senha" required>
            <input type="submit" value="Login">
        </form>
        <div class="error">Erro!
            <?php
                // if (!$_POST['username'] && !$_POST['password'] && $_POST['enviado']) {
                //     echo "Usuário e senha não preenchidos.";
                // } else if (!$_POST['username'] && $_POST['enviado']) {
                //     echo "Usuário não preenchido.";
                // } else if (!$_POST['password'] && $_POST['enviado']) {
                //     echo "Senha não preenchida.";
                // }
            ?>
        </div>
    </div>
</body>

</html>