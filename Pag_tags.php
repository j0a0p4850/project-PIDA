<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
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

        .card-container {

            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            
            max-width: 950px;
           
            margin: 40px auto;
            
        }

        .card {
            width: calc(33.33% - 20px);
            /* Distribui em três colunas */
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 5px;
        }


        /* Cabeçalho */
        header {
            background-color: #f8f9fa;
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
    </style>
    <title>Document</title>
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
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                                </li>';
                    } else {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="cadastro.php">Entrar</a>
                                </li>';
                    }
                    ?>
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
    <div class="card-container">
        <?php
        include 'funcoes_result.php';

        $func = new resultados();
        $func->display_tags_pag_tags();
        ?>
    </div>

    </div>

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