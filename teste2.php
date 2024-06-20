<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot em PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        .chat-container p {
            margin: 10px 0;
        }

        .user-message {
            text-align: right;
            color: #1a0dab;
            background-color: #e1f5fe;
            padding: 8px;
            border-radius: 10px;
            display: inline-block;
            max-width: 70%;
        }

        .bot-message {
            text-align: left;
            color: #757575;
            background-color: #f5f5f5;
            padding: 8px;
            border-radius: 10px;
            display: inline-block;
            max-width: 70%;
        }

        #chat-form {
            margin-top: 20px;
        }

        #user-input {
            width: calc(100% - 70px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #1a0dab;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }

        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #0d47a1;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Navbar</a>
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
                    <li class="nav-item">
                        <a href="Pag_tags.php" class="nav-link">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a href="pagina_de_resultados.php" class="nav-link">Pagina de perguntas</a>
                    </li>
                    <li class="nav-item">
                        <a href="teste2.php" class="nav-link">Chatbot Simples</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
<br>
<br>
    <div class="chat-container">
        <div id="chat-box">
            <p class="bot-message">Olá! Eu sou o seu assistente virtual. Como posso ajudar?</p>
        </div>
        <form id="chat-form">
            <input type="text" id="user-input" placeholder="Digite sua mensagem...">
            <button type="submit">Enviar</button>
            <button type="button" id="clear-chat">Limpar Chat</button>
        </form>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const userInput = document.getElementById('user-input').value.trim();
            if (userInput === '') return;
            addMessage('user', userInput);

            fetch('temporario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'message=' + encodeURIComponent(userInput)
            })
                .then(response => response.json())
                .then(data => {
                    addMessage('bot', data.message);
                })
                .catch(error => {
                    console.error('Erro:', error);
                    addMessage('bot', 'Desculpe, ocorreu um erro ao processar sua solicitação.');
                });

            document.getElementById('user-input').value = '';
        });

        document.getElementById('clear-chat').addEventListener('click', function () {
            const chatBox = document.getElementById('chat-box');
            while (chatBox.firstChild) {
                chatBox.removeChild(chatBox.firstChild);
            }
        });

        function addMessage(sender, message) {
            const chatBox = document.getElementById('chat-box');
            const messageElement = document.createElement('p');
            messageElement.className = sender === 'user' ? 'user-message' : 'bot-message';
            messageElement.textContent = message;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight; // Mantém a rolagem automática para o final
        }
    </script>
</body>

</html>