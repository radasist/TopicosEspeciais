<?php

error_reporting(0);

$page = "configuracoes";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

if ($_POST["enviado"]) {
    $result = $sqlConn->query ("UPDATE configuracoes SET nivelbonus = '".$_POST["nivelbonus"]."', porcentagembonus = '".$_POST["porcentagembonus"]."'");
} else {
    $result = -1;
}


$data = $sqlConn->query("SELECT * FROM configuracoes");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$nivelBonus = $resultArray[0]["nivelbonus"];
$porcentagembonus = $resultArray[0]["porcentagembonus"];

?>


<h1>Configurações</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <label for="nivelbonus">Nível de recorrência do bônus</label>
    <input type="text" id="nivelbonus" name="nivelbonus" placeholder="Nivel bônus" value="<?=$nivelBonus?>" required autofocus>
    <label for="porcentagembonus">Porcentagem do bônus %</label>
    <input type="text" id="porcentagembonus" name="porcentagembonus" placeholder="Porcentagem do bônus" value="<?=$porcentagembonus?>" pattern="[\d]{1,2}\.[\d]{2}" title="Por favor digite um valor com duas casas decimais separadas por ponto." required>
    <input type="submit" page="configuracoes" id="cadastrar" value="Salvar">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        showMessage("success", "Alteração efetuada com sucesso!");
    } else if (<?=(string)$result?> == 0) {
        showMessage("error", "Ocorreu um erro e não foi possível salvar a alteração!");
    }
</script>