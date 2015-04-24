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
        <h1>Cadastro Produto</h1>
        <form>
            <label for="nome">Nome do produto</label>
            <input type="text" id="nome" name="nome" placeholder="Nome do produto" required autofocus>
            <label for="valor">Valor</label>
            <input type="text" id="valor" name="valor" placeholder="Valor (Ex.: 3,15)" required>
            <input type="submit" value="Cadastrar">
        </form>
</body>

</html>