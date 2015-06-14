<?php

error_reporting(0);

$page = "abastecimento";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

$valorProduto = $sqlConn->query ("SELECT valor FROM produtos WHERE id = '".$_POST["produto"]."'");
$resultValorProduto = $valorProduto->fetch_all(MYSQLI_ASSOC);

$total = $_POST["quantidade"] * $resultValorProduto[0]["valor"];

if ($_POST["enviado"]) {
    $result = $sqlConn->query ("INSERT INTO movimentos (cliente, produto, quantidade, total) VALUES ('".$_POST["cliente"]."', '".$_POST["produto"]."', '".$_POST["quantidade"]."', '".$total."')");
} else {
    $result = -1;
}

$dataProdutos = $sqlConn->query("SELECT prod.id, prod.nome, prod.valor, prod.id AS produto, est.nome AS estabelecimento FROM produtos prod, estabelecimentos est WHERE prod.estabelecimento = est.id");
$resultArrayProdutos = $dataProdutos->fetch_all(MYSQLI_ASSOC);
$resultArrayProdutosLength = count($resultArrayProdutos);

$dataClientes = $sqlConn->query("SELECT id, nome, email FROM usuarios");
$resultArrayClientes = $dataClientes->fetch_all(MYSQLI_ASSOC);
$resultArrayClientesLength = count($resultArrayClientes);

?>


<h1>Registro de Abastecimento</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <label for="cliente">Cliente</label>
    <select id="cliente" name="cliente" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayClientesLength; $i++) {
                echo "<option value=\"".$resultArrayClientes[$i]["id"]."\">".$resultArrayClientes[$i]["nome"]." - ".$resultArrayClientes[$i]["email"]."</option>";
            }
        ?>
    </select>
    <label for="produto">Produto</label>
    <select id="produto" name="produto" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayProdutosLength; $i++) {
                echo "<option value=\"".$resultArrayProdutos[$i]["produto"]."\">".$resultArrayProdutos[$i]["nome"]." - R$ ".$resultArrayProdutos[$i]["valor"]." - ".$resultArrayProdutos[$i]["estabelecimento"]."</option>";
            }
        ?>
    </select>
    <label for="quantidade">Quantidade</label>
    <input type="text" id="quantidade" name="quantidade" placeholder="1.000" value="<?=$valor?>" pattern="[\d]{1,10}\.[\d]{3}" title="Por favor digite um quantidade com três casas decimais separadas por ponto." required>

    <input type="submit" page="abastecimento" id="cadastrar" value="Salvar">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        showMessage("success", "Cadastro efetuado com sucesso!");

        $.post("abastecimento.php", {}, function(result){
            $(".principal-container").html(result);
            $(".progress-bar").removeClass("show");
            addPagesListeners();
        });
    } else if (<?=(string)$result?> == 0) {
        showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro!");
    }
</script>