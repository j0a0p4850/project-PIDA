<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['tags']) && is_array($_POST['tags'])) {
        $tags = $_POST['tags'];
        // Retorna as tags selecionadas em formato JSON
        echo json_encode($tags);
    } else {
        echo json_encode(array());
    }
} else {
    echo "Acesso inválido.";
}
?>
