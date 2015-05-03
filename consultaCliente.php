<?php

error_reporting(0);

require("conexao.php");

$data = $sqlConn->query("SELECT * FROM usuarios");
$resultArray = $data->fetch_all(MYSQLI_ASSOC);

$usuariosLength = count($resultArray);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos2.css">

<body>
    <div class="wrapper">
        <h1>Consulta Cliente</h1>
        <a href="cadastroCliente.php">Cadastrar Cliente</a>
        <table>
            <tr>
                <th>Nome</th>
                <th>Data nasc.</th>
                <th>Sexo</th>
                <th>Usuário</th>
            </tr>
            <?php

            for ($i=0; $i<$usuariosLength; $i++) { 
                echo "<tr>".
                    "<td>".$resultArray[$i]["nome"]."</td>".
                    "<td>".$resultArray[$i]["data_nasc"]."</td>".
                    "<td>".$resultArray[$i]["sexo"]."</td>".
                    "<td>".$resultArray[$i]["usuario"]."</td>".
                "</tr>";
            }

            ?>
        </table>
</body>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        var pass = document.querySelector('#senha').value.trim(),
            pass2 = document.querySelector('#senha2').value.trim();

        if (pass != pass2) {
            e.preventDefault();
            alert("As senhas são diferentes!");
            document.querySelector('#senha').focus();
        }
    }, false);

    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            alert("Cadastro efetuado com sucesso!")
        } else {
            alert("Alteração salva com sucesso!")
        }
    } else if (<?=(string)$result?> == 0) {
        alert("Ocorreu um erro, entre em contato com o administrador!");
    }
</script>

</html>