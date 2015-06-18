<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="meusestilos.css">
<link rel="stylesheet" type="text/css" href="sprites/sprites.css">

<script src="jquery-2.1.4.js"></script>

<body class="main-page">
    <div class="bar-top">
        <div class="logo"><img src="LancerCB0.png"></div>
        <div class="text">
            <h1>Sistema Seus Pontos</h1>
            <h2>Para você ir mais longe</h2>
        </div>
    </div>

    <div class="principal-container">

    </div>

    <div class="progress-bar show"></div>

    <div class="message-bar">
        <div class="message-bar-message">Mensagem de teste!</div>
        <div class="message-bar-close"><span class="sprite sprite-close-white"></span></div>
    </div>

    <script src="meusscripts.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var sendForm = $.post("cadastreSe.php", {}, function(result){
            $(".principal-container").html(result);
            $(".progress-bar").removeClass("show");
        });
        sendForm.fail(function() {
            $(".progress-bar").removeClass("show");
            showMessage("error", "Ocorreu um erro e não foi possível completar a ação!");
        });
    });
    </script>
</body>