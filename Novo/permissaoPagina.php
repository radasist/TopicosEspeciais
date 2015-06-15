<?php

$dataPermissao = $sqlConn->query("SELECT permissao FROM usuarios WHERE id = '".$_SESSION["idUsuario"]."'");
$resultArrayPermissao = $dataPermissao->fetch_all(MYSQLI_ASSOC);
$_SESSION["permissao"] = $resultArrayPermissao[0]["permissao"];

if (count($resultArrayPermissao) > 0) {
	if ($page =="configuracoes" && $resultArrayPermissao[0]["permissao"] != "a") {
		die("=(");
	} else if ($page == "abastecimento" && !($resultArrayPermissao[0]["permissao"] == "f" || $resultArrayPermissao[0]["permissao"] == "a")) {
		die("=(");
	}
} else {
	header('Location: index.php');
	die("=(");
}

?>