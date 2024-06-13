<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de Background Metálico com Botão</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #1c1c1c, #333333);
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            color: white;
            padding: 20px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.5);
            max-width: 80%; /* Limita a largura do container */
            margin: 0 auto; /* Centraliza o container na página */
        }

        h1 {
            font-size: 1.8em; /* Tamanho do texto reduzido */
            overflow: hidden; /* Esconde qualquer conteúdo que ultrapasse o tamanho definido */
            border-right: .15em solid white; /* Cria o efeito do cursor de digitação */
            white-space: nowrap; /* Garante que o texto não quebre em várias linhas */
            margin: 0 auto; /* Centraliza o texto horizontalmente */
            letter-spacing: .15em; /* Espaçamento entre as letras */
            animation: typing 4s steps(40, end); /* Animação de digitação */
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 1.8em; /* Tamanho do texto reduzido */
            margin-top: 10px; /* Espaçamento entre o título e o parágrafo */
            white-space: normal; /* Permite que o texto quebre em várias linhas */
            line-height: 1.5; /* Espaçamento entre as linhas */
            opacity: 0; /* Inicialmente esconde o parágrafo */
            animation: fadeIn 1s ease-in-out forwards 4s; /* Animação de fadeIn */
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #1e90ff; /* Azul escuro */
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.2s ease; /* Transição suave */
        }

        .button:hover {
            background-color: #007acc; /* Altera a cor do botão ao passar o mouse */
        }

        /* Estilos do quadrado de informações */
        .info-box {
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px solid #1e90ff; /* Cor da borda azul escuro */
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            display: none; /* Inicialmente oculto */
        }

        .info-box h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 1.2em;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>TechQA Bem-Vindo ao nosso site</h1>
        <p>Aqui compartilhamos nossos conhecimentos.</p>
        <a href="#" class="button" id="about-btn">Sobre o site</a>
    </div>

    <!-- Elemento do quadrado de informações -->
    <div class="info-box" id="info-box">
        <h2>Sobre a TechQA</h2>
        <p>TechQA é uma empresa de tecnologia dedicada a ajudar pessoas com dúvidas em TI e permitir o compartilhamento de conhecimentos entre profissionais da área.</p>
    </div>

    <script>
        // JavaScript para mostrar o quadrado de informações ao clicar no botão
        const aboutBtn = document.getElementById('about-btn');
        const infoBox = document.getElementById('info-box');

        aboutBtn.addEventListener('click', function() {
            infoBox.style.display = 'block'; // Mostra o quadrado de informações
        });
    </script>
</body>
</html>
