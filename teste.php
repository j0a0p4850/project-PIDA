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

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            height: 1020px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            margin: 0;
        }

        .profile-header p {
            margin: 5px 0;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-section h3 {
            margin-top: 0;
        }

        .profile-section ul {
            list-style-type: none;
            padding: 0;
        }

        .profile-section ul li {
            margin-bottom: 10px;
        }

        .file-input {
            display: none;
        }

        .upload-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-btn:hover {
            background-color: #45a049;
        }

        .container_info {
            border: black solid 10px;
        }

        .collapsible.collapsed {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="profile-header">

            <div class="picture">
                <img src="user.png" alt="Foto de Perfil" id="profile-pic">
                <br>
                <label for="file-upload" class="upload-btn">Escolher Foto</label>
                <br>
                <input type="file" id="file-upload" class="file-input" accept="image/*" onchange="previewImage(event)">
                <br>
            </div>

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




                        $func = new funcoes();
                        $id_do_usuario = $_SESSION['funcoes'];
                        $func->display_name(3);

                        ?>
                    </div>


                    <div class="resumo">
                        <h3>Resumo</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            Sed
                            cursus
                            ante dapibus diam.</p>
                    </div>

                    <div class="profile-section">
                        <h3>Experiência Profissional</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Cargo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="profile-section">
                        <h3>Habilidades <span id="toggleSkills" class="toggle-icon">▼</span></h3>
                        <ul class="list-group list-group-flush collapsible collapsed" id="skillsList">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            first item's accordion body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            second item's accordion body. Let's imagine this being filled with some
                                            actual content.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            third item's accordion body. Nothing more exciting happening here in terms
                                            of content, but just filling up the space to make it look, at least at first
                                            glance, a bit more representative of how this would look in a real-world
                                            application.</div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>


    </div>
    </div>



    <script>
        function previewImage(event) {
            var image = document.getElementById('profile-pic');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <script>
        document.getElementById('toggleSkills').addEventListener('click', function () {
            var skillsList = document.getElementById('skillsList');
            if (skillsList.classList.contains('collapsed')) {
                skillsList.classList.remove('collapsed');
                document.getElementById('toggleSkills').innerText = '▼';
            } else {
                skillsList.classList.add('collapsed');
                document.getElementById('toggleSkills').innerText = '►';
            }
        });
    </script>


</body>

</html>