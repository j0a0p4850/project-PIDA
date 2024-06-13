<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-duplo {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
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

    <form id="cadastroForm" method="post" action="pagina_de_processamento.php">
        <label for="user_description">Resumo:</label>
        <textarea id="user_description" name="user_description" rows="4"
            placeholder="Digite um breve resumo"></textarea>

        <label for="habilidades">Habilidades:</label>
        <input type="text" name="habilidades" id="habilidades" placeholder="Ex: HTML, CSS, JavaScript">

        <label for="habilidade_descricao">Descrição da Habilidade:</label>
        <textarea name="habilidade_descricao" id="habilidade_descricao" rows="4"
            placeholder="Descreva suas habilidades em detalhes"></textarea>

        <div class="input-duplo">
            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa" placeholder="Nome da última empresa">

            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" placeholder="Último cargo ocupado">
        </div>

        <button type="submit" id="submitButton">Salvar Alterações</button>
        <div id="formMessages">
            <p class="error-message" id="errorSummary"></p>
            <p class="success-message" id="successMessage"></p>
        </div>
    </form>

    <script>
        const form = document.getElementById('cadastroForm');
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
                displayErrorMessage(null, 'Preencha pelo menos um campo obrigatório.');
            }
        });

        function validateForm() {
            let isValid = false;
            const userDescription = document.getElementById('user_description');
            const habilidades = document.getElementById('habilidades');
            const habilidadeDescricao = document.getElementById('habilidade_descricao');
            const empresa = document.getElementById('empresa');
            const cargo = document.getElementById('cargo');

            if (userDescription.value.trim()) {
                isValid = true;
            }

            if (habilidades.value.trim()) {
                isValid = true;
            }

            if (habilidadeDescricao.value.trim()) {
                isValid = true;
            }

            if (empresa.value.trim()) {
                isValid = true;
            }

            if (cargo.value.trim()) {
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
