<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSite - Início</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos específicos para a página inicial */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .search-container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            position: relative; /* Add position relative */
        }

        .search-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 7px 0 0 7px; /* Rounded corners for the left side */
        }

        .search-button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            background-color: #007bff;
            color: white;
            border-radius: 0 7px 7px 0; /* Rounded corners for the right side */
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-left: none; /* Remove the left border to make it seamless */
        }

        .search-button:hover {
            background-color: #0056b3;
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
            width: 100%; /* Make suggestions container same width as search container */
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    

        .jumbotron {
            background-image: url('background.jpg');
            background-size: cover;
            height: 600px;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .jumbotron p {
            font-size: 1.5rem;
            /*text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);*/
        }

        .feature-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            color: black;
        }

        .feature-box h3 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .feature-box p {
            font-size: 1.2rem;
            color: black;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .footer a {
            color: #ffc107;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .social-icons {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
        }

        .social-icons a:hover {
            color: #ffc107;
        }

        .personas-section {
            background-color: #fff;
            padding: 50px 0;
        }

        .persona-box {
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .persona-box img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .persona-box h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .persona-box p {
            font-size: 1rem;
            color: #666;
        }

        .company-logo {
            width: 150px;
            margin: 20px;
            transition: transform 0.3s;
        }

        .company-logo:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .jumbotron {
                height: 400px;
            }

            .jumbotron h1 {
                font-size: 2.5rem;
            }

            .jumbotron p {
                font-size: 1.2rem;
            }

            .company-logo {
                width: 100px;
                margin: 10px;
            }
        }

        .carousel-personas .carousel-inner {
            transition: transform 0.5s ease; /* Suaviza a transição */
        }

        .carousel-personas .carousel-item {
            transition: opacity 0.5s ease; /* Suaviza a transição de opacidade */
        }
        p{
            color: black;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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
                    <li class="nav-item">
                        <a href="teste2.php" class="nav-link">Chatbot Simples</a>
                    </li>
                </ul>
                <!-- Container para o formulário de pesquisa -->
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

    <!-- Jumbotron -->
    <section class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1>Bem-vindo ao TechSite</h1>
                    <p>Explorando o futuro da tecnologia e conectando pessoas para compartilhar conhecimentos.</p>
                    <a href="#" class="btn btn-primary btn-lg">Saiba Mais</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Tecnologias Avançadas</h3>
                    <p>Descubra as últimas tendências em tecnologia que estão moldando o futuro.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Serviços Personalizados</h3>
                    <p>Oferecemos soluções adaptadas às necessidades específicas de cada cliente.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Compartilhamento de Conhecimentos</h3>
                    <p>Facilitamos a troca de informações e experiências entre profissionais e entusiastas de tecnologia.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Inovação Contínua</h3>
                    <p>Estamos sempre atualizados com as últimas inovações para oferecer o melhor aos nossos usuários.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Comunidade Ativa</h3>
                    <p>Junte-se a uma comunidade vibrante de tecnólogos que ajudam e aprendem juntos.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h3>Recursos Educacionais</h3>
                    <p>Acesse uma vasta gama de recursos educativos para aprimorar suas habilidades tecnológicas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Personas e Empresas -->
    <section class="personas-section">
        <div class="container">
            <h3 class="text-center mb-4">Personas e Empresas</h3>
            <div id="personasCarousel" class="carousel slide carousel-personas" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/face1.jpeg" alt="Persona 1">
                                    <h4>João Silva</h4>
                                    <p>Desenvolvedor de Software</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/face2.jpeg" alt="Persona 2">
                                    <h4>Maria Souza</h4>
                                    <p>Especialista em Segurança</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/man.jpeg" alt="Persona 3">
                                    <h4>Pedro Costa</h4>
                                    <p>Engenheiro de Redes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/man2.jpeg" alt="Persona 4">
                                    <h4>Lucas Oliveira</h4>
                                    <p>Analista de Dados</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/mulhe.jpeg" alt="Persona 5">
                                    <h4>Ana Pereira</h4>
                                    <p>Desenvolvedora Frontend</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="persona-box">
                                    <img src="imgs/man3.jpeg" alt="Persona 6">
                                    <h4>Carlos Santos</h4>
                                    <p>Especialista em IA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#personasCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#personasCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div id="empresasCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="imgs/apple-removebg-preview.png" alt="Empresa 1" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/educ-removebg-preview.png" alt="Empresa 2" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/claro-removebg-preview.png" alt="Empresa 3" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/eventos-removebg-preview.png" alt="Empresa 4" class="company-logo">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="imgs/meta-removebg-preview.png" alt="Empresa 5" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/google-removebg-preview.png" alt="Empresa 6" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/celebro-removebg-preview.png" alt="Empresa 7" class="company-logo">
                            </div>
                            <div class="col-md-3">
                                <img src="imgs/pp-removebg-preview.png" alt="Empresa 8" class="company-logo">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#empresasCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#empresasCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>TechSite</h5>
                    <p>Sua fonte confiável para inovação em tecnologia.</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Serviços</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Desenvolvimento Web</a></li>
                        <li><a href="#">Consultoria em TI</a></li>
                        <li><a href="#">Segurança Cibernética</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p>Email: info@techsite.com</p>
                    <p>Telefone: +123456789</p>
                </div>
            </div>
            <hr>
            <p class="text-center">© 2024 TechSite. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        // Ajusta o tempo de intervalo para o carrossel de personas
        var personasCarousel = document.querySelector('#personasCarousel');
        var carouselInstance = new bootstrap.Carousel(personasCarousel, {
            interval: 2000, // Tempo de intervalo em milissegundos (2 segundos)
            ride: 'carousel'
        });
    </script>

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

        function realizarPesquisa(inputVal) {
            if (inputVal.length > 0) {
                window.location.href = 'pag_result_pesquisa.php?termo=' + encodeURIComponent(inputVal);
            }
        }
    </script>
</body>

</html>
