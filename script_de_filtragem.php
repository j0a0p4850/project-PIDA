<?php

function filtrarResultados($status, $tags, $ano) {
    
    $resultadosFiltrados = "<div class='resultados-filtrados'>";
    // Adicione os resultados filtrados aqui
    $resultadosFiltrados .= "</div>";
    return $resultadosFiltrados;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $tags = isset($_POST['tags']) ? $_POST['tags'] : null;
    $ano = isset($_POST['ano']) ? $_POST['ano'] : null;

    
    if ($status !== null || $tags !== null || $ano !== null) {
        $resultadosFiltrados = filtrarResultados($status, $tags, $ano);
        
        echo $resultadosFiltrados;
    } else {
        
        echo "Exibindo todos os resultados";
    }
}
?>
