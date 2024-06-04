<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $to = $email;
    $subject = "Confirmação de E-mail";
    $message = "Por favor, clique no link abaixo para confirmar seu e-mail:\n\nhttp://localhost:3000/teste2.php/confirm.php?email=" . urlencode($email);
    $headers = "From: jp.jpr.jp@gmail.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "E-mail de confirmação enviado!";
    } else {
        echo "Erro ao enviar o e-mail de confirmação.";
    }
}
?>