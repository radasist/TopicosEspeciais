<?php

error_reporting(0);

require("conexao.php");


if ($_POST["id"]) {
    $result = $sqlConn->query("DELETE FROM usuarios WHERE id = '".$_POST["id"]."'");
} else {
    $result = -1;
}

$data = $sqlConn->query("SELECT id, nome, DATE_FORMAT(data_nasc,'%d/%m/%Y') as data_nasc, sexo, usuario FROM usuarios");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$usuariosLength = count($resultArray);

?>

<h1>Consulta Cliente</h1>
<a href="#" page="cadastroCliente" class="link">Cadastrar Cliente</a>
<table>
    <tr>
        <th>Nome</th>
        <th>Data nasc.</th>
        <th>Sexo</th>
        <th>Usuário</th>
        <th colspan="2">Ações</th>
    </tr>
    <?php

    for ($i=0; $i<$usuariosLength; $i++) { 
        if ($resultArray[$i]["sexo"] == "masc") {
            $sexo = "Masculino";
        } else {
            $sexo = "Feminino";
        }

        echo "<tr>".
            "<td>".$resultArray[$i]["nome"]."</td>".
            "<td>".$resultArray[$i]["data_nasc"]."</td>".
            "<td>".$sexo."</td>".
            "<td>".$resultArray[$i]["usuario"]."</td>".
            "<td><a href=\"#\" page=\"cadastroCliente\" data=\"".$resultArray[$i]["id"]."\" class=\"link\">Alterar</a></td>".
            "<td><a href=\"#\" page=\"consultaCliente\" data=\"".$resultArray[$i]["id"]."\" msg=\"Tem certeza que deseja excluir '".$resultArray[$i]["nome"]."'?\"  class=\"confirm\">Excluir</a></td>".
        "</tr>";
    }

    ?>
</table>

<script>
    if (<?=(string)$result?> == 1) {
        alert("Cadastro excluído com sucesso!")
    } else if (<?=(string)$result?> == 0) {
        alert("Ocorreu um erro ao exluir o contato, entre em contato com o administrador!")
    }
</script>