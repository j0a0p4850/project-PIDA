<?php
// Inclui o arquivo temporario.php que contém a classe Teste_mensagem
include 'temporario.php';

// Inicializa a variável $input_value como vazia
$input_value = "";

// Verifica se o formulário foi submetido e se o campo 'input_value' foi definido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['input_value'])) {
    // Atribui o valor submetido à variável $input_value
    $input_value = $_POST['input_value'];

    // Cria uma instância da classe Teste_mensagem e chama a função test com o valor submetido
    $func = new Teste_mensagem;
    $func->test4($input_value);

    // Acessa e exibe a mensagem modificada pela função test
     // Exibe: Mensagem teste (ou outra mensagem, dependendo da lógica)
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilo básico para a navbar */
        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar HTML -->
    <div class="navbar">
        <a href="#home" class="active">Home</a>
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact</a>
    </div>

    <!-- Formulário HTML para permitir ao usuário digitar o valor "True" -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="input_value">Digite o valor "True":</label>
        <input type="text" id="input_value" name="input_value" required>
        <input type="submit" value="Submit">
    </form>

    <?php
        echo $func->getVarMsg();
    ?>
</body>
</html>
