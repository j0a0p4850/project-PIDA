<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Comentário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

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
        .ql-container.ql-snow{
            height: 10rem;
        }
        
    </style>
</head>

<body>

    <div class="container">
        <form id="editarRespostaForm" method="POST"
            action="process_edicao_resp.php?resp_edicao_id=<?php echo $_GET['resp_edicao_id']; ?>" onsubmit="prepareSubmissionEditResp()">
            <label for="resp_body">Descrição do Comentário:</label>
            <div id="edicao-comentario"></div>
                <input type="hidden" name="resp_body" id="resp_body" rows="4" placeholder="Digite o novo conteúdo do comentário">
            <div class="error-message" id="errorSummary"></div>
            <button type="submit" id="submitButton">Modificar</button>
        </form>
        
                                    
    </div>


    <script>
        var quill = new Quill('#edicao-comentario', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                    [{ size: [] }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' },
                    { 'indent': '-1' }, { 'indent': '+1' }],
                    ['code', 'link'],
                    ['clean']
                ]
            }
        });

        function prepareSubmissionEditResp() {
            var postBody = document.querySelector('input[name=resp_body]');
            postBody.value = quill.root.innerHTML;
        }
    </script>

    <script>
        const form = document.getElementById('editarRespostaForm');
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
            const comentarioBody = document.getElementById('resp_body').value.trim();
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
