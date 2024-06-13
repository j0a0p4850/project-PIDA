<?php

include 'funcao_adm.php';

$conexao = new conexaoDB();
$func = new administrador_func($conexao->conectar());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Certifique-se de iniciar a sessão
    
    if (isset($_SESSION['login'])) {

        $id_user_q_denunciou = $_SESSION['login'];
        $id_user = null;
        $reasons = isset($_POST['reason']) ? $_POST['reason'] : [];
        $otherReason = isset($_POST['otherReason']) ? $_POST['otherReason'] : '';
        $id_coringa = null;

        if (isset($_POST['id_pergunta'])) {
            $id_coringa = $_POST['id_pergunta'];
            $func->denuncia_registro($reasons, $otherReason, $id_user, $id_coringa, $id_user_q_denunciou , 'pergunta');
        } elseif (isset($_POST['id_comentario'])) {
            $id_coringa = $_POST['id_comentario'];
            $func->denuncia_registro($reasons, $otherReason, $id_user, $id_coringa, $id_user_q_denunciou, 'comentario');
        } elseif (isset($_POST['id_resposta'])){
            $id_coringa = $_POST['id_resposta'];
            $func->denuncia_registro($reasons, $otherReason, $id_user, $id_coringa, $id_user_q_denunciou, 'resposta');
        } else {
            echo 'ERROR: No valid ID provided.';
        }
        
    } else {
        header('Location: login.php');
        exit(); // Certifique-se de sair após o redirecionamento
    }
} else {
    echo 'No POST request received.';
}
?>
