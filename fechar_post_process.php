<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['postagem_fech_id'])) {
    $id_post = $_GET['postagem_fech_id']; 
    $usuario->fechar_post($id_post); 

    
    header('Location: pagina_de_resultados.php?id='.$id_post);
} else {
    echo "ID do comentário não especificado.";
}
?>