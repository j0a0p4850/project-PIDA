<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['postagem_id'])) {
    $postId = $_GET['postagem_id']; 
    $usuario->excluir_Post($postId); 

    
    header('Location: pagina_de_resultados.php?id='.$postId);
} else {
    echo "ID do comentário não especificado.";
}
?>
