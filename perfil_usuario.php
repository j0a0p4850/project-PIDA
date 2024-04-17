<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - LinkedIn</title>

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
                        include 'funcoes_usuario.php';
                        session_start();
                        if (isset($_SESSION['login'])) {
                            $func = new funcoes();
                            $id_do_usuario = $_SESSION['login'];
                            $func->display_name($id_do_usuario);
                            $func->body_perfil_display($id_do_usuario);
                        } else {
                            header('Location: login.php');
                        }
                        ?>
                    </div>
                </div>
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