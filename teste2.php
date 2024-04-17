<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet">
</head>

<body>

    <h1>Exemplo de área de código com botão de cópia</h1>

    <div class="code-container">
        <pre><code class="language-php">
            <?php
            // Seu código PHP aqui
            if(isset($_POST['codigo'])){
            echo htmlspecialchars($_POST['codigo']);
            } 
            else{
                echo "Não há nenhum codigo";
            }
            ?>
        </code></pre>
        <button onclick="copyCode()">Copiar Código</button>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <textarea name="codigo" rows="10" cols="50" placeholder="Digite seu código aqui"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-php.js"></script>

    <script>
        function copyCode() {
            var codeBlock = document.querySelector('.code-container code');
            var codeText = codeBlock.innerText || codeBlock.textContent;

            navigator.clipboard.writeText(codeText)
                .then(function () {
                    console.log('Copiado com sucesso')
                })
                .catch(function () {
                    alert("Erro ao copiar o código.");
                });
        }
    </script>

</body>

</html>
