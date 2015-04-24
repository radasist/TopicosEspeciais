<?php

error_reporting(0);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos2.css">

<body>
    <div class="wrapper">
        <h1>Cadastro Estabelecimento</h1>
        <form>
            <label for="nome">Nome fantasia</label>
            <input type="text" id="nome" name="nome" placeholder="Nome fantasia" required autofocus>
            <label for="razao">Razão social</label>
            <input type="text" id="razao" name="razao" placeholder="Razão social" required autofocus>
            <input type="submit" value="Cadastrar">
        </form>
</body>

</html>