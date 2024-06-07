<?php

include 'funcoes_usuario.php';

$func = new funcoes();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $func->esquecer_senha($email);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form id="loginForm" action="email_redef_senha.php" method="POST">
        <input type="email" name="email" id="email">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>