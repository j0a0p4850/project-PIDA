<?php
session_start();
include 'funcao_adm.php';

$conexaoDB = new conexaoDB();
$conexao = $conexaoDB->conectar();
$func = new administrador_func($conexao);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $password = $_POST['password'];
    $id_adm = $func->logar_adm($code, $password);

    if ($id_adm) {
        //$_SESSION['admin_login'] = $id_adm;
    } else {
        echo "Credenciais inválidas.";
    }
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
    <title>Login administrador</title>
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
                <a class="navbar-brand" href="index.php">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <?php
                        if (isset($_SESSION['login'])) {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                                </li>';
                        } else {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="cadastro.php">Entrar</a>
                                </li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a href="Pag_tags.php" class="nav-link">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a href="pagina_de_resultados.php" class="nav-link">Pagina de perguntas</a>
                        </li>
                    </ul>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Pesquisar..."
                            oninput="buscarSugestoes(this.value)">
                        <button type="button" class="search-button"
                            onclick="realizarPesquisa(document.getElementById('searchInput').value)">Pesquisar</button>
                        <div class="suggestions-container" id="suggestions"></div>
                    </div>
                </div>
            </div>
        </nav>



    <div class="container">
        <h2>Login</h2>
        <form action="login_adm.php" method="POST">
            <div class="form-group">
                <label for="email">Codigo de acesso:</label>
                <input type="text" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Logar</button>
        </form>

    </div>

    <script>
        const email = "jp.jpr.jp@gmail.com";
        
        function verificarSintaxeEmail(email) {
            const padrao = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return padrao.test(email);
        }

        // Exemplo de uso

        console.log(verificarSintaxeEmail(email));  // true ou false


        async function verificarDominioEmail(email) {
            const dominio = email.split('@')[1];
            const url = `https://dns.google/resolve?name=${dominio}&type=MX`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                return data.Answer && data.Answer.length > 0;
            } catch (error) {
                console.error('Erro ao verificar o domínio:', error);
                return false;
            }
        }

        verificarDominioEmail(email).then(isValid => console.log(isValid));  // true ou false


        async function verificarEmail(email) {
            if (!verificarSintaxeEmail(email)) {
                return false;
            }
            if (!await verificarDominioEmail(email)) {
                return false;
            }
            return true;
        }


        verificarEmail(email).then(isValid => console.log(isValid));  // true ou false


    </script>
</body>

</html>