<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Comentário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }
        
    </style>
</head>

<body>

    <div class="container">
        <form id="editarComentarioForm" method="POST"
            action="editar_processar_comentario.php?comentario_edicao_id=<?php echo $_GET['comentario_edicao_id']; ?>">
            <label for="comentario_body">Descrição do Comentário:</label>
            <textarea name="comentario_body" id="comentario_body" rows="4"
                placeholder="Digite o novo conteúdo do comentário"></textarea>
            <div class="error-message" id="errorSummary"></div>
            <button type="submit" id="submitButton">Modificar</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('editarComentarioForm');
        const submitButton = document.getElementById('submitButton');
        const errorSummary = document.getElementById('errorSummary');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            clearMessages();

            if (validateForm()) {
                // Simula envio do formulário
                setTimeout(function () {
                    form.submit();
                }, 1000);
            } else {
                displayErrorMessage('Preencha o campo de descrição do comentário.');
            }
        });

        function validateForm() {
            const comentarioBody = document.getElementById('comentario_body').value.trim();
            return comentarioBody.length > 0;
        }

        function displayErrorMessage(message) {
            errorSummary.innerText = message;
        }

        function clearMessages() {
            errorSummary.innerText = '';
        }
    </script>

</body>

</html>
