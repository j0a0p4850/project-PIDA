<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Postagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.tiny.cloud/1/8yln0fabv11j4dqdp2vbwfa3kdpa8utsvfu7rxbey1xlo6xl/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
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

        input[type="text"],
        textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
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

        .success-message {
            color: #28a745;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <form id="editarPostForm" method="POST"
        action="processar_editar_post.php?postagem_edit_id=<?php echo $_GET['postagem_edit_id']; ?>">
        <label for="pergunta_title">Título:</label>
        <input type="text" id="pergunta_title" name="pergunta_title" rows="2" cols="50"
            placeholder="Digite o título da postagem"></input>

        <label for="pergunta_descricao">Descrição:</label>
        <textarea name="pergunta_descricao" id="pergunta_descricao" placeholder="Descrição da postagem" rows="4"
            cols="50"></textarea>

        <button type="submit" id="submitButton">Modificar</button>
        <div id="formMessages">
            <p class="error-message" id="errorSummary"></p>
            <p class="success-message" id="successMessage"></p>
        </div>
    </form>

    <script>
        const form = document.getElementById('editarPostForm');
        const submitButton = document.getElementById('submitButton');
        const errorSummary = document.getElementById('errorSummary');
        const successMessage = document.getElementById('successMessage');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            clearMessages();

            if (validateForm()) {
                // Simula envio do formulário
                setTimeout(function () {
                    form.submit();
                }, 1000);
            } else {
                displayErrorMessage(null, 'Preencha pelo menos um campo.');
            }
        });

        function validateForm() {
            let isValid = false;
            const titulo = document.getElementById('pergunta_title');
            const descricao = document.getElementById('pergunta_descricao');

            if (titulo.value.trim()) {
                isValid = true;
            }

            if (descricao.value.trim()) {
                isValid = true;
            }

            return isValid;
        }

        function displayErrorMessage(field, message) {
            if (field) {
                const errorParagraph = field.nextElementSibling;
                errorParagraph.innerText = message;
                field.classList.add('is-invalid');
            } else {
                errorSummary.innerText = message;
            }
        }

        function clearMessages() {
            errorSummary.innerText = '';
            successMessage.innerText = '';
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(msg => msg.innerText = '');
            const formFields = document.querySelectorAll('input, textarea');
            formFields.forEach(field => field.classList.remove('is-invalid'));
        }
    </script>

</body>

</html>
