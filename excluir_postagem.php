<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['postagem_id'])) {
    $postId = $_GET['postagem_id']; 
    $usuario->excluir_Post($postId); 

    echo json_encode(['status' => 'success', 'message' => 'Post excluído com sucesso']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID do post não especificado']);
}
?>
