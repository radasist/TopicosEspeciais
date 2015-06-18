<?php

error_reporting(0);

$page = "saldo";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

if ($_POST["cliente"]) {
    $id = $_POST["cliente"];
} else {
    $id = $_SESSION["idUsuario"];
}

$data = $sqlConn->query ("SELECT bonus FROM usuarios WHERE id = '".$id."'");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);
$bonus = $resultArray[0]["bonus"];

$dataClientes = $sqlConn->query("SELECT id, nome, email FROM usuarios");
$resultArrayClientes = $dataClientes->fetch_all(MYSQLI_ASSOC);
$resultArrayClientesLength = count($resultArrayClientes);
?>


<h1>Consulta Saldo Bônus</h1>
<form class="cadastro-cliente">
    <?php if ($_SESSION["permissao"] == "a" || $_SESSION["permissao"] == "f") { ?>
    <input type="hidden" name="enviado" value="1">
    <label for="cliente">Cliente</label>
    <select id="cliente" name="cliente" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayClientesLength; $i++) {
                $seleted = "";
                if ($resultArrayClientes[$i]["id"] == $id) {
                    $seleted = "selected";
                }
                echo "<option value=\"".$resultArrayClientes[$i]["id"]."\" $seleted>".$resultArrayClientes[$i]["nome"]." - ".$resultArrayClientes[$i]["email"]."</option>";
            }
        ?>
    </select>
    <input type="submit" page="saldo" id="cadastrar" value="Consultar">
    <?php } ?>
</form>
<p>O saldo de bônus disponível é de <strong>R$ <?=$bonus?></strong>.</p>