<?php

error_reporting(0);

$page = "movimentos";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

if ($_POST["cliente"]) {
    $id = $_POST["cliente"];
} else {
    $id = $_SESSION["idUsuario"];
}

$data = $sqlConn->query ("SELECT prod.nome AS produto, mov.quantidade, mov.total FROM movimentos mov, produtos prod WHERE mov.produto = prod.id AND mov.cliente = '".$id."' ORDER BY mov.id");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);
$resultLength = count($resultArray);

$dataClientes = $sqlConn->query("SELECT id, nome, email FROM usuarios");
$resultArrayClientes = $dataClientes->fetch_all(MYSQLI_ASSOC);
$resultArrayClientesLength = count($resultArrayClientes);
?>


<h1>Consulta Movimentos</h1>
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
    <input type="submit" page="movimentos" id="cadastrar" value="Consultar">
    <?php } ?>
</form>
<table>
    <tr>
        <th>Produto</th>
        <th>Valor R$</th>
        <th>Quantidade</th>
        <th>Total R$</th>
    </tr>
    <?php

    for ($i=0; $i<$resultLength; $i++) {
        $valor = $resultArray[$i]["total"] / $resultArray[$i]["quantidade"];
        $valor = number_format($valor, 2, ".", "");
        echo "<tr>".
            "<td>".$resultArray[$i]["produto"]."</td>".
            "<td>".$valor."</td>".
            "<td>".$resultArray[$i]["quantidade"]."</td>".
            "<td>".$resultArray[$i]["total"]."</td>".
        "</tr>";
    }

    ?>
</table>