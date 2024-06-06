<?php
include 'conexao_db.php';

$conexao = new conexaoDB();
$conecta = $conexao->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_first_name = $_POST[''];
    $user_last_name = $_POST[''];
    $user_name = $_POST[''];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Criptografar a senha usando bcrypt
    

}
    // Armazenar o e-mail e a senha criptografada
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="teste2.php" method="POST">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Cadastrar</button>
    </form>

    <a href="temporario.php"><button>login</button></a>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('loginForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            form.addEventListener('submit', function (event) {
                console.log('Form submit event triggered');

                if (email.value.trim() === '') {
                    event.preventDefault();
                    alert('Por favor, preencha o campo de e-mail.');
                    return;
                }

                if (!email.value.includes('.com')) {
                    event.preventDefault();
                    alert('O e-mail deve conter ".com".');
                    return;
                }

                if (password.value.trim() === '') {
                    event.preventDefault();
                    alert('Por favor, preencha o campo de senha.');
                    return;
                }

                const passwordValue = password.value;
                const passwordLength = passwordValue.length;
                const hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
                const hasNumber = /\d/.test(passwordValue);

                if (passwordLength < 4 || passwordLength > 20) {
                    event.preventDefault();
                    alert('A senha deve ter entre 4 e 20 caracteres.');
                    return;
                }

                if (!hasSpecialCharacter) {
                    event.preventDefault();
                    alert('A senha deve conter pelo menos um caractere especial.');
                    return;
                }

                if (!hasNumber) {
                    event.preventDefault();
                    alert('A senha deve conter pelo menos um número.');
                    return;
                }

                // Criptografar a senha antes de enviar o formulário
                const encryptedPassword = CryptoJS.SHA256(password.value).toString();

                // Logging the encrypted password to the console for debugging
                console.log('Senha Criptografada:', encryptedPassword);

                // Substituir a senha com a versão criptografada
                password.value = encryptedPassword;
            });
        });
    </script>
</body>
</html>
