<?php

include 'conexao_db.php';

$conexao = new conexaoDB();
$conecta = $conexao->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Conectar ao banco de dados
  

    if ($conecta->connect_error) {
        die("Conexão falhou: " . $conecta->connect_error);
    }

    // Verificar se o e-mail existe
    $stmt = $conecta->prepare("SELECT user_password FROM tb_usuario WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verificar se a senha fornecida corresponde à senha criptografada armazenada
        if (password_verify($password, $hashedPassword)) {
            echo "Login bem-sucedido!";
            //header('Location: perfil_usuario.php');
        } else {
            echo "E-mail ou senha incorretos.";
        }
    } else {
        echo "E-mail ou senha incorretos.";
    }

    $stmt->close();
    $conecta->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
</head>
<body>
    <h2>Login de Usuário</h2>
    <form action="temporario.php" method="POST">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
