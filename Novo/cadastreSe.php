<?php

error_reporting(0);

//$page = "cadastre_se";

session_start();
require_once("conexao.php");
//require_once("permissaoPagina.php");


if ($_POST["enviado"]) {
    $emailCadastrado = $sqlConn->query ("SELECT 1 FROM usuarios WHERE email = '".$_POST["email"]."'");
    $resultEmailCadastrado = $emailCadastrado->fetch_all(MYSQLI_ASSOC);

    if (count($resultEmailCadastrado) == 0) {
        $result = $sqlConn->query ("INSERT INTO usuarios (nome, data_nasc, sexo, email, senha, permissao) VALUES ('".$_POST["nome"]."', '".$_POST["datanasc"]."', '".$_POST["sexo"]."', '".$_POST["email"]."', '".md5($_POST["senha"])."', '".$_POST["permissao"]."')");
    } else {
        $result = 2;
    }
} else {
    $result = -1;
}


if ($result == 2) {
    $id = "0";
    $nome = $_POST["nome"];
    $datanasc = $_POST["datanasc"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senha2 = $_POST["senha2"];
    $permissao = $_POST["permissao"];
} else {
    $id = "0";
    $nome = "";
    $datanasc = "";
    $sexo = "";
    $email = "";
    $senha = "";
    $senha2 = "";
    $permissao = "";
}

$sexomasc == "";
$sexofem == "";
if ($sexo == "masc") {
    $sexomasc = "checked";
} else if ($sexo == "fem"){
    $sexofem = "checked";
}

?>

<h1>Cadastre-se</h1>
<form class="cadastro-cliente" validate="usuario">
    <input type="hidden" name="enviado" value="1">
    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" value="<?=$nome?>" required autofocus>
    <label for="datanasc">Data de nascimento</label>
    <input type="date" id="datanasc" name="datanasc" placeholder="Data de nascimento" value="<?=$datanasc?>" required>
    <label>Sexo</label>
    <div class="line"><input type="radio" id="masc" name="sexo" value="masc" <?=$sexomasc?> required><label for="masc">Masculino</label><input type="radio" id="fem" name="sexo" value="fem" <?=$sexofem?> required><label for="fem">Feminino</label></div>
    <label for="usuario">Email</label>
    <input type="text" id="email" name="email" placeholder="Email" value="<?=$email?>" pattern="[a-z\d\.]{1,}@[a-zA-Z\d\.]{1,}[\.][a-zA-Z\d\.]{2,3}" title="Digite um email válido." required>
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" placeholder="Senha" value="<?=$senha?>" required>
    <label for="senha2">Repita a senha</label>
    <input type="password" id="senha2" name="senha2" placeholder="Repita a senha" value="<?=$senha2?>" required>
    <input type="hidden" name="permissao" value="a">
    <input type="submit" page="cadastreSe" id="cadastrar" value="Cadastre-se">
</form>
    
<script type="text/javascript">
$(document).ready(function() {
	 $("input[type=submit]").each(function() {
    	$(this).click(function(e){
    		if ($("form")[0].checkValidity() == true && isValid() == true) {
    			e.preventDefault();
    			$(".progress-bar").addClass("show");
	    		var sendForm = $.post($(this).attr("page")+".php", getFormValues(), function(result){
	                $(".principal-container").html(result);
	                $(".progress-bar").removeClass("show");
	            });
	            sendForm.fail(function() {
	            	$(".progress-bar").removeClass("show");
					showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro/alteração!");
				});
    		} else if ($("form")[0].checkValidity() == true) {
    			e.preventDefault();
    		}
    	});
    });

 	if (<?=(string)$result?> == 1) {
        showMessage("success", "Cadastro efetuado com sucesso! Em alguns instantes você será redirecionado à pagina de login!", 5000);
        window.setTimeout(function() {
        	$(location).attr("href","index.php");
        }, 5500);
    } else if (<?=(string)$result?> == 0) {
    	showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro!");
    } else if (<?=(string)$result?> == 2) {
        showMessage("error", "Email já cadastrado no sistema!");
    }
});
</script>