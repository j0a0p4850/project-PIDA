<?php
session_start();
include 'funcoes_usuario.php';
$func = new funcoes();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
} 

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/8yln0fabv11j4dqdp2vbwfa3kdpa8utsvfu7rxbey1xlo6xl/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="style.css">

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
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="profile-header">

            <br>
            <br>
            <div class="choice">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
                </div>
            </div>
            <br>
            <div class="container_info">
                <div class="profile-section">
                    <div class="name">
                        <?php
                        if(isset($_SESSION['login'])) {
                            $id_do_usuario = $_SESSION['login'];
                            $func->display_name($id_do_usuario);
                            $func->body_perfil_display($id_do_usuario);
                        }
                        ?>

                    </div>

                </div>
                <a href="pag_criacao_pergunta.php"><button type="button">Criar pergunta</button></a>
                <a href="logout.php"><button type="button">Logout</button></a>
            </div>
        </div>
    </div>


    </div>
    </div>




    <script>
        document.getElementById('toggleSkills').addEventListener('click', function () {
            var skillsList = document.getElementById('skillsList');
            if (skillsList.classList.contains('collapsed')) {
                skillsList.classList.remove('collapsed');
                document.getElementById('toggleSkills').innerText = '🞁';
            } else {
                skillsList.classList.add('collapsed');
                document.getElementById('toggleSkills').innerText = '🞃';
            }
        });
    </script>


</body>

</html>