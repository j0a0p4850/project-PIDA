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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
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

        .filter_data {
            display: block;
            flex-wrap: wrap;
            justify-content: space-between;
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
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="text" id="live_search" placeholder="Search"
                            aria-label="Search">
                        <div id="searchresult"></div>
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
                    <div id="status" style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <input class="common_selector status" type="checkbox" name="status" id="abertos" value="Aberta">
                        <label for="abertos">Abertos</label><br>
                        <input class="common_selector status" type="checkbox" name="status" id="fechados"
                            value="Fechada">
                        <label for="fechados">Fechadas</label><br>
                    </div>
                </li>
                <?php
                include "funcoes_result.php";
                $func = new resultados();
                $func->show_tags();
                ?>
                </li>
                <li class="list-group-item">
                    <h4>Data</h4>
                    <select name="data_post" id="data_post" class="common_selector">
                        <option value="">Escolha a data</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                    <span id="valorAno"></span>
                </li>
                <li class="list-group-item"><button type="button" id="btnFiltrar" class="btn btn-info"
                        data-bs-dismiss="modal">Filtrar</button>
                    <button id="reset_filters" class="btn btn-secondary">Resetar Filtros</button>
                </li>
            </ul>
        </div>
    </div>

    <main>
        <div class="col-md-9">
            <div class="filter_data">
                <!-- Conteúdo filtrado será inserido aqui -->
            </div>
        </div>
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
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            filter_data();
            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var tags = get_filter('tags');
                var status = get_filter('status');
                var data_post = $('#data_post').val();
                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: { action: action, tags: tags, status: status, data_post: data_post },
                    success: function (data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function () {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').on('click change', function () {
                filter_data();
            });

            $('#reset_filters').click(function () {
                $('.common_selector').prop('checked', false);
                $('#data_post').val('');
                filter_data();
            });
        });
    </script>
</body>

</html>
