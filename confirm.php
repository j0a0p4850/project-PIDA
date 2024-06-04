<?php
if (isset($_GET['email'])) {
    $email = urldecode($_GET['email']);
    // Aqui você pode adicionar lógica adicional para confirmar o e-mail, como atualizar um banco de dados
    echo "E-mail " . htmlspecialchars($email) . " confirmado com sucesso!";
} else {
    echo "E-mail de confirmação inválido.";
}
?>
