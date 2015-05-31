<?php

error_reporting(0);

require("conexao.php");

$data = $sqlConn->query("SELECT id, nome, DATE_FORMAT(data_nasc,'%d/%m/%Y') as data_nasc, sexo, usuario FROM usuarios");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$usuariosLength = count($resultArray);

?>

<h1>Consulta Cliente</h1>
<a href="#" page="cadastroCliente">Cadastrar Cliente</a>
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
            "<td><a href=\"#\" page=\"cadastroCliente\" data=\"".$resultArray[$i]["id"]."\">Alterar</a></td>".
            "<td><a href=\"#\">Excluir</a></td>".
        "</tr>";
    }

    ?>
</table>

<script>
    // document.querySelector('form').addEventListener('submit', function(e) {
    //     var pass = document.querySelector('#senha').value.trim(),
    //         pass2 = document.querySelector('#senha2').value.trim();

    //     if (pass != pass2) {
    //         e.preventDefault();
    //         alert("As senhas são diferentes!");
    //         document.querySelector('#senha').focus();
    //     }
    // }, false);

    // if (<?=(string)$result?> == 1) {
    //     if (<?=(string)$id?> == 0) {
    //         alert("Cadastro efetuado com sucesso!")
    //     } else {
    //         alert("Alteração salva com sucesso!")
    //     }
    // } else if (<?=(string)$result?> == 0) {
    //     alert("Ocorreu um erro, entre em contato com o administrador!");
    // }
</script>