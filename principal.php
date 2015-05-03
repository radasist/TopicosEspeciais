<?php

error_reporting(0);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">

<body>
    <div class="principal-wrapper">
        <div class="menu-container">
            <h1>Menu</h1>
            <h3>Consultas</h3>
            <ul>
                <li><a href="consultaSaldo.php" target="principal-iframe">Saldo</a></li>
                <li><a href="consultaMovimentos.php" target="principal-iframe">Movimentos</a></li>
            </ul>
            <h3>Registro</h3>
            <ul>
                <li><a href="abastecer.php" target="principal-iframe">Abastecimento</a></li>
            </ul>
            <h3>Cadastros/Consultas</h3>
            <ul>
                <li><a href="consultaCliente.php" target="principal-iframe">Clientes</a></li>
                <li><a href="cadastroEstabelecimento.php" target="principal-iframe">Estabelecimentos</a></li>
                <li><a href="cadastroGrupo.php" target="principal-iframe">Grupos de estabelecimentos</a></li>
                <li><a href="cadastroProduto.php" target="principal-iframe">Produtos</a></li>
            </ul>
            <h3>Sistema</h3>
            <ul>
                <li><a href="configuracoes.php" target="principal-iframe">Configurações</a></li>
            </ul>
        </div>
        <div class="principal-container">
            <iframe src="ola.php" name="principal-iframe"></iframe>
        </div>
    </div>
</body>

</html>