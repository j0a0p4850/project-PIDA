<?php

include 'funcao_adm.php';

$conexao = new conexaoDB();
$func = new administrador_func($conexao->conectar());

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_user = null;  
    $reasons = isset($_POST['reason']) ? $_POST['reason'] : [];
    $otherReason = isset($_POST['otherReason']) ? $_POST['otherReason'] : '';
    $id_pergunta = isset($_POST['id_pergunta']) ? $_POST['id_pergunta'] : null;

    //$func->denuncia_registro($reasons, $otherReason, $id_user, $reportType, $id_pergunta, $id_comentario, $id_resposta);

    // Chamando a função para processar o relatório
    $func->denuncia_registro($reasons, $otherReason, $id_user, 'pergunta', $id_pergunta, null, null);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Confirmation</title>
</head>
<body>
    <h1>Report Confirmation</h1>
    <p>Reasons for reporting:</p>
    <ul>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($reasons)) {
                foreach ($reasons as $reason) {
                    echo "<li>" . htmlspecialchars($reason) . "</li>";
                }
            }
            if (!empty($otherReason)) {
                echo "<li>Other: " . htmlspecialchars($otherReason) . "</li>";
            }
        }
        ?>
    </ul>
</body>
</html>
