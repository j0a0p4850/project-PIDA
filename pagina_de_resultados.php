<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Minha Página</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Cabeçalho */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* Menu principal */
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

        /* Seção de perguntas e respostas */
        main {
            padding: 20px;
        }

        .question {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;


        }

        .question h2 {
            font-size: 18px;
            margin: 0;
        }

        .question p {
            font-size: 14px;
            margin: 0;
        }

        .c1 {
            float: left;
            margin-top: 30px;
            margin-left: 20px;
        }

        main {
            margin-left: 300px;
        }

        /* Painel lateral */
        aside {
            background-color: #eee;
            padding: 10px;
        }

        .share {
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="pagina_de_resultados.php" class="nav-link">Pagina de perguntas</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="text" id="live_search" placeholder="Search"
                            aria-label="Search">
                        <div id="searchresult">


                        </div>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="card c1" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Filtros</h5>
            <div>
                <br>
            </div>

            <ul class="list-group">
                <li class="list-group-item">
                    <div class="btn-group dropup share">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" type="button">Todos</button></li>
                            <li><button class="dropdown-item" type="button">Abertos</button></li>
                            <li><button class="dropdown-item" type="button">Fechadas</button></li>
                        </ul>
                    </div>
                </li>
                <li class="list-group-item"> <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        TAGS
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Escolha as tags para o filtro
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    
                                    include "funcoes_result.php";
                                    $func = new resultados();
                                    $func->show_tags();
                                    ?>
                                </div>
                                <div class="modal-body">
                                    <h4>Topico</h4>
                                    <input type="checkbox" name="Hardware" id="Hardware" value="Hardware">
                                    <label for="Hardware">Hardware</label>
                                    <input type="checkbox" name="software" id="software" value="software">
                                    <label for="software">Software</label>
                                </div>
                                <div class="modal-body">
                                    <input type="checkbox" name="js" id="js" value="js">
                                    <label for="js">JavaScript</label>
                                </div>
                                <div class="modal-body">
                                    <input type="checkbox" name="bd" id="bd" value="bd">
                                    <label for="bd">Banco de Dados</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h4>Data</h4>
                    <select name="pets" id="pet-select">
                        <option value="">Escolha a data</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                    <span id="valorAno"></span>
                </li>
                <li class="list-group-item"><button type="button" id="btnFiltrar" class="btn btn-info"
                        data-bs-dismiss="modal">Filtrar</button></li>

            </ul>




            <?php

            function filtrarResultados($status, $tags, $ano)
            {


                $resultadosFiltrados = "<div class='resultados-filtrados'>";

                $resultadosFiltrados .= "</div>";
                return $resultadosFiltrados;
            }


            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $status = isset($_POST['status']) ? $_POST['status'] : null;
                $tags = isset($_POST['tags']) ? $_POST['tags'] : null;
                $ano = isset($_POST['ano']) ? $_POST['ano'] : null;


                if ($status !== null || $tags !== null || $ano !== null) {
                    $resultadosFiltrados = filtrarResultados($status, $tags, $ano);

                    echo $resultadosFiltrados;
                } else {

                    echo "Exibindo todos os resultados";
                }
            }
            ?>








        </div>

    </div>

    <main>
        <?php



        $func = new resultados();

        $func->result();

        ?>
    </main>

    <script>
        document.getElementById('btnFiltrar').addEventListener('click', function () {

            const status = document.querySelector('#statusDropdown .dropdown-item.active').textContent.trim();
            const selectedTags = Array.from(document.querySelectorAll('input[name="tags"]:checked')).map(checkbox => checkbox.value);
            const selectedYear = document.getElementById('pet-select').value;


            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'script_de_filtragem.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        document.getElementById('resultados').innerHTML = xhr.responseText;
                    } else {
                        console.error('Erro ao processar a solicitação de filtragem');
                    }
                }
            };

            xhr.send(JSON.stringify({ status: status, tags: selectedTags, year: selectedYear }));
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#live_search").keyup(function () {

                var input = $(this).val();

                if (input != "") {
                    $.ajax({

                        url: "livesearch.php",
                        method: "POST",
                        data: { input: input },

                        success: function (data) {
                            $("#searchresult").html(data);
                        }
                    });
                } else {
                    $("#searchresult").html("");
                }
            })
        })
    </script>
</body>

</html>