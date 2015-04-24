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
        <h1>Cadastro Cliente</h1>
        <form>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required autofocus>
            <label for="datanasc">Data de nascimento</label>
            <input type="date" id="datanasc" name="datanasc" placeholder="Data de nascimento" required>
            <label>Sexo</label>
            <div class="line"><input type="radio" id="masc" name="sexo"><label for="masc">Masculino</label><input type="radio" id="fem" name="sexo"><label for="fem">Feminino</label></div>
            <label for="username">Usuário</label>
            <input type="text" id="username" name="username" placeholder="Usuário" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <label for="senha2">Repita a senha</label>
            <input type="password" id="senha2" name="senha2" placeholder="Repita a senha" required>
            <input type="submit" id="cadastrar" value="Cadastrar">
        </form>
</body>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        var pass = document.querySelector('#senha').value.trim(),
            pass2 = document.querySelector('#senha2').value.trim();

        if (pass != pass2) {
            e.preventDefault();
            alert("As senhas são diferentes!");
            document.querySelector('#senha').focus();
        }
    }, false);
</script>

</html>