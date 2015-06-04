<?php

error_reporting(0);

require_once("conexao.php");

if ($_POST["id"]) {
    $id = $_POST["id"];
}

if ($_POST["enviado"]) {
    if ($_POST["id"] == "0") {
        $result = $sqlConn->query ("INSERT INTO usuarios (nome, data_nasc, sexo, usuario, senha, permissao) VALUES ('".$_POST["nome"]."', '".$_POST["datanasc"]."', '".$_POST["sexo"]."', '".$_POST["usuario"]."', '".$_POST["senha"]."', 'a')");
    } else {
        $result = $sqlConn->query ("UPDATE usuarios SET nome = '".$_POST["nome"]."', data_nasc = '".$_POST["datanasc"]."', sexo = '".$_POST["sexo"]."', usuario = '".$_POST["usuario"]."', senha = '".$_POST["senha"]."', permissao = 'a' WHERE id = '$id'");
    }
} else {
    $result = -1;
}

if ($_POST["id"]) {
    $data = $sqlConn->query("SELECT * FROM usuarios WHERE id = '$id'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    $nome = $resultArray[0]["nome"];
    $datanasc = $resultArray[0]["data_nasc"];
    $sexo = $resultArray[0]["sexo"];
    $usuario = $resultArray[0]["usuario"];
    $senha = $resultArray[0]["senha"];

    $labelTitle = "Alteração";
    $labelSubmit = "Salvar";
} else {
    $id = "0";
    $nome = "";
    $datanasc = "";
    $sexo = "";
    $usuario = "";
    $senha = "";

    $labelTitle = "Cadastro";
    $labelSubmit = "Cadastrar";
}

if ($sexo == "masc") {
    $sexomasc = "checked";
} else if ($sexo == "fem"){
    $sexofem = "checked";
} else {
    $sexomasc == "";
    $sexofem == "";
}

?>


<h1><?=$labelTitle?> Cliente</h1>
<form method="post" action="cadastroCliente.php" class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" value="<?=$nome?>" required autofocus>
    <label for="datanasc">Data de nascimento</label>
    <input type="date" id="datanasc" name="datanasc" placeholder="Data de nascimento" value="<?=$datanasc?>" required>
    <label>Sexo</label>
    <div class="line"><input type="radio" id="masc" name="sexo" value="masc" <?=$sexomasc?> required><label for="masc">Masculino</label><input type="radio" id="fem" name="sexo" value="fem" <?=$sexofem?> required><label for="fem">Feminino</label></div>
    <label for="usuario">Usuário</label>
    <input type="text" id="usuario" name="usuario" placeholder="Usuário" value="<?=$usuario?>" required>
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" placeholder="Senha" value="<?=$senha?>" required>
    <label for="senha2">Repita a senha</label>
    <input type="password" id="senha2" name="senha2" placeholder="Repita a senha" value="<?=$senha?>" required>
    <input type="submit" page="cadastroCliente" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    document.querySelector('form').addEventListener('submit', function(e) {
        var pass = document.querySelector('#senha').value.trim(),
            pass2 = document.querySelector('#senha2').value.trim();

        if (pass != pass2) {
            e.preventDefault();
            alert("As senhas são diferentes!");
            document.querySelector('#senha').focus();
        }
    }, false);

    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuada com sucesso!");
        } else {
            showMessage("success", "Alteração efetuada com sucesso!");
        }
    } else if (<?=(string)$result?> == 0) {
        if (<?=(string)$id?> == 0) {
            showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro!");
        } else {
            showMessage("error", "Ocorreu um erro e não foi possível salvar a alteração!");
        }
    }
</script>