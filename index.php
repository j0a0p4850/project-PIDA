<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechQA - Sobre Nós</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Estilos CSS personalizados */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .box {
            width: 300px;
            height: 300px;
            margin: 10px;
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            overflow-y: auto;
        }

        .box p {
            margin: 0;
        }

        .button-container {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .footer h5 {
            font-size: 16px;
            font-weight: bold;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer .col {
            margin-bottom: 20px;
        }

        .social {
            display: flex;
            float: left;
        }

        .options {
            margin-left: 8px;
        }

        /* Estilos para o cabeçalho */
        header {
            background-color: #f8f9fa;
            color: #000;
            padding: 20px;
            text-align: center;
        }

        /* Estilos para o menu principal */
        nav {
            background-color: #444;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        /* Estilos para a seção principal */
        main {
            padding: 20px;
        }

        .search-container {
            position: relative;
            width: 300px;
            display: flex;
        }

        .search-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 7px;
        }

        .suggestions-container {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            z-index: 10;
            color: #000;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TechQA</a>
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
                        <a href="pagina_de_resultados.php" class="nav-link">Página de Perguntas</a>
                    </li>
                </ul>
                <!-- Container para o formulário de pesquisa -->
                <div class="search-container">
                    <form>
                        <input type="text" id="searchInput" class="search-input" placeholder="Pesquisar..."
                            oninput="buscarSugestoes(this.value)">
                        <div class="suggestions-container" id="suggestions"></div>
                        <button type="button"
                            onclick="realizarPesquisa(document.getElementById('searchInput').value)">Pesquisar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

   

    <!-- Informações sobre a TechQA -->
    <main>
    <div class="container">
            <h1>Sobre a TechQA</h1>
        </div>
        <div class="container">
            <div class="box">
                <h2>Nossa Missão</h2>
                <p>Nossa missão na TechQA é fornecer soluções de segurança cibernética, análise de dados e recursos educacionais de qualidade para profissionais de tecnologia em todo o mundo.</p>
            </div>
            <div class="box">
                <h2>Nossos Serviços</h2>
                <p>Oferecemos consultoria especializada em segurança cibernética, treinamentos avançados em análise de dados e uma plataforma de aprendizado com cursos práticos em tecnologia.</p>
            </div>
            <div class="box">
                <h2>Nossa Comunidade</h2>
                <p>Construímos uma comunidade global de profissionais de TI que compartilham conhecimentos, discutem tendências emergentes e colaboram para resolver desafios tecnológicos.</p>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Links Úteis</h5>
                    <ul>
                        <li><a href="#">Sobre nós</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5>Redes Sociais</h5>
                    <div class="social">
                        <a href="#">Github</a>
                        <br>
                        <a href="#">LinkedIn</a>
                        <br>
                        <a href="#">Instagram</a>
                    </div>
                </div>
                <div class="col">
                   
                    <form>
                        <input type="email" placeholder="Digite seu e-mail">
                        <button type="submit">Novas informações</button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>

        function buscarSugestoes(inputVal) {
            if (inputVal.length > 0) {
                fetch('livesearch.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'input=' + encodeURIComponent(inputVal)
                })
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsContainer = document.getElementById('suggestions');
                        suggestionsContainer.innerHTML = '';
                        data.forEach(sugestao => {
                            const div = document.createElement('div');
                            div.textContent = sugestao;
                            div.classList.add('suggestion-item');
                            div.onclick = function () {
                                document.querySelector('.search-input').value = this.textContent;
                                suggestionsContainer.innerHTML = '';
                            };
                            suggestionsContainer.appendChild(div);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        }

        // Função para realizar a pesquisa
        function realizarPesquisa(inputVal) {
            if (inputVal.length > 0) {
                window.location.href = 'pag_result_pesquisa.php?termo=' + encodeURIComponent(inputVal);
            }
        }
    </script>
</body>

</html>