<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['comentario_id'])) {
    $comentarioId = $_GET['comentario_id'];
    $usuario->excluirComentario($comentarioId);


} else {
    echo "ID do comentário não especificado.";
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


    <script>
        alert('Comentario excluido com sucesso');
        setTimeout(function () {
            window.history.back();
        }, 300); 
    </script>
</body>

</html>