<?php
session_start();
include 'funcoes_result.php';
$func = new resultados();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $comment_body = $_POST['comment_body'];
    $resp_id = $_POST['id'];
    if ($comment_body != '') {
        if (isset($_SESSION['login'])) {
            $id_user = $_SESSION['login'];

            $func->inserir_comentarios($comment_body, $id_user, $resp_id);
        } else {
            header('login.php');
        }
    }
    else{
        echo '<script>alert("Nao está enviando nada")</script>';
    }
} else {
    echo 'Nao está passando o post';
}





