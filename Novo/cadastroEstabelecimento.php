<?php

error_reporting(0);

require_once("conexao.php");

if ($_POST["id"]) {
    $id = $_POST["id"];
}

if ($_POST["enviado"]) {
    if ($_POST["id"] == "0") {
        $result = $sqlConn->query ("INSERT INTO estabelecimentos (nome, razaosocial, grupo) VALUES ('".$_POST["nome"]."', '".$_POST["razaosocial"]."', '".$_POST["grupo"]."')");
    } else {
        $result = $sqlConn->query ("UPDATE estabelecimentos SET nome = '".$_POST["nome"]."', razaosocial = '".$_POST["razaosocial"]."', grupo = '".$_POST["grupo"]."' WHERE id = '$id'");
    }
} else {
    $result = -1;
}

if ($_POST["id"]) {
    $data = $sqlConn->query("SELECT * FROM estabelecimentos WHERE id = '$id'");
    $resultArray = $data->fetch_all(MYSQLI_ASSOC);

    $nome = $resultArray[0]["nome"];
    $razaosocial = $resultArray[0]["razaosocial"];
    $grupo = $resultArray[0]["grupo"];

    $labelTitle = "Alteração";
    $labelSubmit = "Salvar";
} else {
    $id = "0";
    $nome = "";
    $razaosocial = "";
    $grupo = "";

    $labelTitle = "Cadastro";
    $labelSubmit = "Cadastrar";
}

$dataGrupoEstabelecimentos = $sqlConn->query("SELECT * FROM grupoestabelecimentos");
$resultArrayGrupoEstabelecimentos = $dataGrupoEstabelecimentos->fetch_all(MYSQLI_ASSOC);
$resultArrayGrupoEstabelecimentosLength = count($resultArrayGrupoEstabelecimentos);

?>


<h1><?=$labelTitle?> Estabelecimento</h1>
<form class="cadastro-cliente">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome fantasia</label>
    <input type="text" id="nome" name="nome" placeholder="Nome fantasia" value="<?=$nome?>" required autofocus>
    <label for="razaosocial">Razão social</label>
    <input type="text" id="razaosocial" name="razaosocial" placeholder="Razão social" value="<?=$razaosocial?>" required>
    <label for="grupo">Grupo</label>
    <select id="grupo" name="grupo" required>
        <option value="">Selecione...</option>
        <?php
            for ($i=0; $i<$resultArrayGrupoEstabelecimentosLength; $i++) {
                $selectedItem = "";
                if ($grupo == $resultArrayGrupoEstabelecimentos[$i]["id"]) {
                    $selectedItem = "selected";
                }
                echo "<option value=\"".$resultArrayGrupoEstabelecimentos[$i]["id"]."\" $selectedItem>".$resultArrayGrupoEstabelecimentos[$i]["nome"]."</option>";
            }
        ?>
    </select>

    <input type="submit" page="cadastroEstabelecimento" id="cadastrar" value="<?=$labelSubmit?>">
</form>


<script type="text/javascript">
    if (<?=(string)$result?> == 1) {
        if (<?=(string)$id?> == 0) {
            showMessage("success", "Cadastro efetuada com sucesso!");
        } else {
            showMessage("success", "Alteração efetuada com sucesso!");
        }

        $.post("consultaEstabelecimento.php", {}, function(result){
            $(".principal-container").html(result);
            $(".progress-bar").removeClass("show");
            addPagesListeners();
        });
    } else if (<?=(string)$result?> == 0) {
        if (<?=(string)$id?> == 0) {
            showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro!");
        } else {
            showMessage("error", "Ocorreu um erro e não foi possível salvar a alteração!");
        }
    }
</script>