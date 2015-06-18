<?php

error_reporting(0);

$page = "indicacao";

session_start();
require_once("conexao.php");
require_once("permissaoPagina.php");

if ($_POST["enviado"]) {
    $existe = $sqlConn->query ("SELECT 1 FROM indicacao WHERE emailindicado = '".$_POST["emailindicado"]."'");
    $resultExiste = $existe->fetch_all(MYSQLI_ASSOC);

    $cadastrado = $sqlConn->query ("SELECT 1 FROM usuarios WHERE email = '".$_POST["emailindicado"]."'");
    $resultCadastrado = $cadastrado->fetch_all(MYSQLI_ASSOC);

    if (count($resultExiste) == 0 && count($resultCadastrado) == 0) {
        $result = $sqlConn->query ("INSERT INTO indicacao (indica, indicado, emailindicado) VALUES ('".$_POST["indica"]."', 0,'".$_POST["emailindicado"]."')");
    } else {
        $result = 2;
    }
} else {
    $result = -1;
}

$dataClientes = $sqlConn->query("SELECT id, nome, email FROM usuarios");
$resultArrayClientes = $dataClientes->fetch_all(MYSQLI_ASSOC);
$resultArrayClientesLength = count($resultArrayClientes);

if ($_POST["indica"]) {
    $id = $_POST["indica"];
} else {
    $id = $_SESSION["idUsuario"];
}

?>


<h1>Indicações</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <?php if ($_SESSION["permissao"] == "a" || $_SESSION["permissao"] == "f") { ?>
    <label for="indica">Quem indica</label>
    <select id="indica" name="indica" required>
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
    <?php } ?>
    <label for="emailindicado">Email do Indicado</label>
    <input type="text" id="emailindicado" name="emailindicado" placeholder="Email do Indicado" pattern="[a-z\d\.]{1,}@[a-zA-Z\d\.]{1,}[\.][a-zA-Z\d\.]{2,3}" title="Digite um email válido." required>
    <input type="submit" page="indicacao" id="cadastrar" value="Salvar">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        showMessage("success", "Indicação efetuada com sucesso!");
    } else if (<?=(string)$result?> == 0) {
        showMessage("error", "Ocorreu um erro e não foi possível completar a indicação!");
    } else if (<?=(string)$result?> == 2) {
        showMessage("error", "Esse email já foi indicado ou já está cadastrado!");
    }
</script>