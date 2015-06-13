<?php

error_reporting(0);

$page = "abastecimento";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

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

$dataProdutos = $sqlConn->query("SELECT prod.id, prod.nome, prod.valor, est.nome AS estabelecimento FROM produtos prod, estabelecimentos est WHERE prod.estabelecimento = est.id");
$resultArrayProdutos = $dataProdutos->fetch_all(MYSQLI_ASSOC);
$resultArrayProdutosLength = count($resultArrayProdutos);

?>


<h1>Registro de Abastecimento</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Produto</label>
    <select id="estabelecimento" name="estabelecimento" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayProdutosLength; $i++) {
                echo "<option value=\"".$resultArrayProdutos[$i]["valor"]."\">".$resultArrayProdutos[$i]["nome"]." - R$ ".$resultArrayProdutos[$i]["valor"]." - ".$resultArrayProdutos[$i]["estabelecimento"]."</option>";
            }
        ?>
    </select>
    <label for="valor">Quantidade</label>
    <input type="text" id="quantidade" name="quantidade" placeholder="1.000" value="<?=$valor?>" pattern="[\d]{1,10}\.[\d]{3}" title="Por favor digite um quantidade com três casas decimais separadas por ponto." required>

    <input type="submit" page="cadastroProduto" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuada com sucesso!");
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