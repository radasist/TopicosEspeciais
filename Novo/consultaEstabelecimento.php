<?php

error_reporting(0);

$page = "cadastros_consultas";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

if ($_POST["id"]) {
    $result = $sqlConn->query("DELETE FROM grupoestabelecimentos WHERE id = '".$_POST["id"]."'");
} else {
    $result = -1;
}

$data = $sqlConn->query("SELECT est.id, est.nome, est.razaosocial, grp.nome as grupo FROM estabelecimentos est, grupoestabelecimentos grp WHERE est.grupo = grp.id");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$resultLength = count($resultArray);

?>

<h1>Consulta Estabelecimentos</h1>
<span page="cadastroEstabelecimento" class="link">Cadastrar Estabelecimento</span>
<table>
    <tr>
        <th>Nome fantasia</th>
        <th>Razão social</th>
        <th>Grupo</th>
        <th>Ações</th>
    </tr>
    <?php

    for ($i=0; $i<$resultLength; $i++) { 
        echo "<tr>".
            "<td>".$resultArray[$i]["nome"]."</td>".
            "<td>".$resultArray[$i]["razaosocial"]."</td>".
            "<td>".$resultArray[$i]["grupo"]."</td>".
            "<td><span page=\"cadastroEstabelecimento\" data=\"".$resultArray[$i]["id"]."\" class=\"link sprite sprite-edit-black\" title=\"Editar\"></span>".
            "<span page=\"consultaEstabelecimento\" data=\"".$resultArray[$i]["id"]."\" msg=\"Tem certeza que deseja excluir '".$resultArray[$i]["nome"]."'?\"  class=\"confirm sprite sprite-delete-black\" title=\"Excluir\"></span></td>".
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