<?php

error_reporting(0);

require_once("conexao.php");

if ($_POST["id"]) {
    $id = $_POST["id"];
}

if ($_POST["enviado"]) {
    if ($_POST["id"] == "0") {
        $result = $sqlConn->query ("INSERT INTO produtos (nome, valor, estabelecimento) VALUES ('".$_POST["nome"]."', '".$_POST["valor"]."', '".$_POST["estabelecimento"]."')");
    } else {
        $result = $sqlConn->query ("UPDATE produtos SET nome = '".$_POST["nome"]."', razaosocial = '".$_POST["valor"]."', grupo = '".$_POST["estabelecimento"]."' WHERE id = '$id'");
    }
} else {
    $result = -1;
}

if ($_POST["id"]) {
    $data = $sqlConn->query("SELECT * FROM produtos WHERE id = '$id'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    $nome = $resultArray[0]["nome"];
    $valor = $resultArray[0]["valor"];
    $estabelecimento = $resultArray[0]["estabelecimento"];

    $labelTitle = "Alteração";
    $labelSubmit = "Salvar";
} else {
    $id = "0";
    $nome = "";
    $valor = "";
    $estabelecimento = "";

    $labelTitle = "Cadastro";
    $labelSubmit = "Cadastrar";
}

$dataEstabelecimentos = $sqlConn->query("SELECT * FROM estabelecimentos");
$resultArrayEstabelecimentos = $dataEstabelecimentos->fetch_all(MYSQLI_ASSOC);
$resultArrayEstabelecimentosLength = count($resultArrayEstabelecimentos);

?>


<h1><?=$labelTitle?> Produto</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" value="<?=$nome?>" required autofocus>
    <label for="valor">Valor R$</label>
    <input type="text" id="valor" name="valor" placeholder="12.90" value="<?=$valor?>" pattern="[\d]{1,10}\.[\d]{2}" title="Por favor digite um valor com duas casas decimais separadas por ponto." required>
    <label for="estabelecimento">Estabelecimento</label>
    <select id="estabelecimento" name="estabelecimento" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayEstabelecimentosLength; $i++) {
                $selectedItem = "";
                if ($estabelecimento == $resultArrayEstabelecimentos[$i]["id"]) {
                    $selectedItem = "selected";
                }
                echo "<option value=\"".$resultArrayEstabelecimentos[$i]["id"]."\" $selectedItem>".$resultArrayEstabelecimentos[$i]["nome"]."</option>";
            }
        ?>
    </select>

    <input type="submit" page="cadastroProduto" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuado com sucesso!");
        } else {
            showMessage("success", "Alteração efetuada com sucesso!");
        }

        $.post("consultaProduto.php", {}, function(result){
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