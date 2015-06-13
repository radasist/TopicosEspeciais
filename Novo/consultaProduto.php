<?php

error_reporting(0);

require_once("conexao.php");


if ($_POST["id"]) {
    $result = $sqlConn->query("DELETE FROM grupoestabelecimentos WHERE id = '".$_POST["id"]."'");
} else {
    $result = -1;
}

$data = $sqlConn->query("SELECT prod.id, prod.nome, prod.valor, est.nome as estabelecimento FROM produtos prod, estabelecimentos est WHERE prod.estabelecimento = est.id");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$resultLength = count($resultArray);

?>

<h1>Consulta Produtos</h1>
<span page="cadastroProduto" class="link">Cadastrar Produto</span>
<table>
    <tr>
        <th>Produto</th>
        <th>Valor R$</th>
        <th>Estabelecimento</th>
        <th>Ações</th>
    </tr>
    <?php

    for ($i=0; $i<$resultLength; $i++) { 
        echo "<tr>".
            "<td>".$resultArray[$i]["nome"]."</td>".
            "<td>".$resultArray[$i]["valor"]."</td>".
            "<td>".$resultArray[$i]["estabelecimento"]."</td>".
            "<td><span page=\"cadastroProduto\" data=\"".$resultArray[$i]["id"]."\" class=\"link sprite sprite-edit-black\" title=\"Editar\"></span>".
            "<span page=\"consultaProduto\" data=\"".$resultArray[$i]["id"]."\" msg=\"Tem certeza que deseja excluir '".$resultArray[$i]["nome"]."'?\"  class=\"confirm sprite sprite-delete-black\" title=\"Excluir\"></span></td>".
        "</tr>";
    }

    ?>
</table>

<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        showMessage("success", "Ação completada com sucesso!");
    } else if (<?=(string)$result?> == 0) {
        showMessage("error", "Ocorreu um erro e não foi possível completar a ação solicitada!");
    }
</script>