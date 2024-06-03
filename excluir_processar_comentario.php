<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['comentario_id'])) {
    $comentarioId = $_GET['comentario_id']; 
    $usuario->excluirComentario($comentarioId); 

    
    header('Location: pagina_de_resultados.php?id='.$comentarioId);
} else {
    echo "ID do comentário não especificado.";
}
?>
