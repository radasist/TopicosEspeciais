<?php

error_reporting(0);

require_once("conexao.php");

if ($_POST["id"]) {
    $id = $_POST["id"];
}

if ($_POST["enviado"]) {
    if ($_POST["id"] == "0") {
        $emailCadastrado = $sqlConn->query ("SELECT 1 FROM usuarios WHERE email = '".$_POST["email"]."'");
        $resultEmailCadastrado = $emailCadastrado->fetch_all(MYSQLI_ASSOC);

        if (count($resultEmailCadastrado) == 0) {
            $result = $sqlConn->query ("INSERT INTO usuarios (nome, data_nasc, sexo, email, senha, permissao) VALUES ('".$_POST["nome"]."', '".$_POST["datanasc"]."', '".$_POST["sexo"]."', '".$_POST["email"]."', '".md5($_POST["senha"])."', '".$_POST["permissao"]."')");
        } else {
            $result = 2;
        }
    } else {
        if ($_POST["senha"] != "") {
            $result = $sqlConn->query ("UPDATE usuarios SET nome = '".$_POST["nome"]."', data_nasc = '".$_POST["datanasc"]."', sexo = '".$_POST["sexo"]."', email = '".$_POST["email"]."', senha = '".md5($_POST["senha"])."', permissao = '".$_POST["permissao"]."' WHERE id = '$id'");
        } else {
            $result = $sqlConn->query ("UPDATE usuarios SET nome = '".$_POST["nome"]."', data_nasc = '".$_POST["datanasc"]."', sexo = '".$_POST["sexo"]."', email = '".$_POST["email"]."', permissao = '".$_POST["permissao"]."' WHERE id = '$id'");
        }
    }
} else {
    $result = -1;
}

$labelTitle = "Cadastro";
$labelSubmit = "Cadastrar";
$passwordRequired = "required";

if ($_POST["id"]) {
    $data = $sqlConn->query("SELECT * FROM usuarios WHERE id = '$id'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    $nome = $resultArray[0]["nome"];
    $datanasc = $resultArray[0]["data_nasc"];
    $sexo = $resultArray[0]["sexo"];
    $email = $resultArray[0]["email"];
    $senha = "";
    $senha2 = "";
    $permissao = $resultArray[0]["permissao"];

    $labelTitle = "Alteração";
    $labelSubmit = "Salvar";
    $passwordRequired = "";
} else if ($result == 2) {
    $id = "0";
    $nome = $_POST["nome"];
    $datanasc = $_POST["datanasc"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senha2 = $_POST["senha2"];
    $permissao = $_POST["permissao"];
} else {
    $id = "0";
    $nome = "";
    $datanasc = "";
    $sexo = "";
    $email = "";
    $senha = "";
    $senha2 = "";
    $permissao = "";
}

$sexomasc == "";
$sexofem == "";
if ($sexo == "masc") {
    $sexomasc = "checked";
} else if ($sexo == "fem"){
    $sexofem = "checked";
}

$permissaoA = "";
$permissaoF = "";
$permissaoC = "";
if ($permissao == "a") {
    $permissaoA = "selected";
} else if ($permissao == "f") {
    $permissaoF = "selected";
} else if ($permissao == "c") {
    $permissaoC = "selected";
}

?>


<h1><?=$labelTitle?> Cliente</h1>
<form class="cadastro-cliente" validate="usuario">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" value="<?=$nome?>" required autofocus>
    <label for="datanasc">Data de nascimento</label>
    <input type="date" id="datanasc" name="datanasc" placeholder="Data de nascimento" value="<?=$datanasc?>" required>
    <label>Sexo</label>
    <div class="line"><input type="radio" id="masc" name="sexo" value="masc" <?=$sexomasc?> required><label for="masc">Masculino</label><input type="radio" id="fem" name="sexo" value="fem" <?=$sexofem?> required><label for="fem">Feminino</label></div>
    <label for="usuario">Email</label>
    <input type="text" id="email" name="email" placeholder="Email" value="<?=$email?>" pattern="[a-z\d\.]{1,}@[a-zA-Z\d\.]{1,}[\.][a-zA-Z\d\.]{2,3}" title="Digite um email válido." required>
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" placeholder="Senha" value="<?=$senha?>" <?=$passwordRequired?>>
    <label for="senha2">Repita a senha</label>
    <input type="password" id="senha2" name="senha2" placeholder="Repita a senha" value="<?=$senha2?>" <?=$passwordRequired?>>
    <label for="permissao">Permissão</label>
    <select id="permissao" name="permissao" required>
        <option value="">Selecione...</option>
        <option value="a" <?=$permissaoA?>>Administrador</option>
        <option value="f" <?=$permissaoF?>>Frentista</option>
        <option value="c" <?=$permissaoC?>>Cliente</option>
    </select>
    <input type="submit" page="cadastroCliente" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuada com sucesso!");
        } else {
            showMessage("success", "Alteração efetuada com sucesso!");
        }

        $.post("consultaCliente.php", {}, function(result){
            $(".principal-container").html(result);
            $(".progress-bar").removeClass("show");
            addPagesListeners();
        });
    } else if (<?=(string)$result?> == 0) {
        if (<?=(string)$id?> == 0) {
            showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro!");
        } else {
            showMessage("error", "Ocorreu um erro e não foi possível salvar a alteração!");
        }
    } else if (<?=(string)$result?> == 2) {
        showMessage("error", "Email já cadastrado no sistema!");
    }
</script>