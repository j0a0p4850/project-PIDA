<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['postagem_id'])) {
    $postId = $_GET['postagem_id'];
    $usuario->excluir_Post($postId);

    echo "<script>
    alert('Post excluído com sucesso');
    setTimeout(function () {
        window.history.go(-2);
    }, 200); 
</script>";
} else {
    echo "<script>alert('Algo deu errado, por favor tente novamente')</script>";
}
?>