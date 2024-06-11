<?php
include 'conexao_db.php';

$sugestoes = array();
if(isset($_POST["input"])){
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();
    $input = $_POST["input"];

    $query = "SELECT pergunta_title FROM tb_pergunta WHERE pergunta_title LIKE '%{$input}%' LIMIT 3";
    $result = mysqli_query($conecta, $query);

    while($row = mysqli_fetch_assoc($result)){
        $sugestoes[] = $row['pergunta_title'];
    }
    
    // Retorne a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($sugestoes);
    exit();
}
?>
