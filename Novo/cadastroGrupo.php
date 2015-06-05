<?php

error_reporting(0);

require_once("conexao.php");

if ($_POST["id"]) {
    $id = $_POST["id"];
}

if ($_POST["enviado"]) {
    if ($_POST["id"] == "0") {
        $result = $sqlConn->query ("INSERT INTO grupoestabelecimentos (nome) VALUES ('".$_POST["nome"]."')");
    } else {
        $result = $sqlConn->query ("UPDATE grupoestabelecimentos SET nome = '".$_POST["nome"]."' WHERE id = '$id'");
    }
} else {
    $result = -1;
}

if ($_POST["id"]) {
    $data = $sqlConn->query("SELECT * FROM grupoestabelecimentos WHERE id = '$id'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    $nome = $resultArray[0]["nome"];

    $labelTitle = "Alteração";
    $labelSubmit = "Salvar";
} else {
    $id = "0";
    $nome = "";

    $labelTitle = "Cadastro";
    $labelSubmit = "Cadastrar";
}

?>


<h1><?=$labelTitle?> Grupo de Estabelecimentos</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" value="<?=$nome?>" required autofocus>
    <input type="submit" page="cadastroGrupo" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuada com sucesso!");
        } else {
            showMessage("success", "Alteração efetuada com sucesso!");
        }

        $.post("consultaGrupo.php", {}, function(result){
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
    }
</script>