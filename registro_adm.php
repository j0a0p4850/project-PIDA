<?php

include 'funcao_adm.php';

$func = new administrador_func($conecta);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_administrador = $_POST['nome_administrador'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Registra o administrador
    $func->registra_adm($nome_administrador, $hashedPassword);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pagina_de_resultados.php" class="nav-link">Pagina de perguntas</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form id="loginForm" action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="first_name">nome_administrador:</label>
                <input type="text" id="nome_administrador" name="nome_administrador" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>

    
       


    </div>


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

                
            });
        });
    </script>
</body>

</html>