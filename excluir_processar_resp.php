<?php
include 'funcoes_result.php';
$usuario = new resultados();

if (isset($_GET['resp_id'])) {
    $resp_id = $_GET['resp_id']; 
    $usuario->excluirResposta($resp_id); 

    
    header('Location: pagina_de_resultados.php?id='.$resp_id);
} else {
    echo "ID do comentário não especificado.";
}
?>
