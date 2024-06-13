
<?php
session_start();
include 'funcoes_result.php';
$func = new resultados();
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        .container {
            width: 100%;
            border: 1px solid black;
        }

        .header,
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        .content {
            padding: 20px;
            border: 1px solid #dee2e6;
        }

        @media (max-width: 600px) {

            .header,
            .footer {
                text-align: center;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/7jodojbng5amadhee2m4fr5wh2e1uxbzn8p07lrxngqhu81c/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Navbar</a>
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
                    
                </div>
            </div>
        </nav>
        <br>
        <br>
        

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="header">
                <h1>Titulo</h1>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Titulo Publicação</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" name="post_title" required>
                </div>

            </div>
            <div class="content">
                <textarea placeholder="Escreva sua publicação aqui" name="post_body" required>

                </textarea>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                TAGS
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">TAGS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <?php
                                $func->show_tags();
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar
                                Tags</button>
                        </div>

                    </div>

                </div>

            </div>
            <div class="tag-selection">
                
                <input type="hidden" name="selected_tags" id="selectedTagsInput">
                <div class="footer">
                    <button type="submit" class="btn btn-success">Salvar Publicação</button>
                </div>

            </div>
        </div>
    </form>





    <?php


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['login'])) {
            $user_id = $_SESSION['login'];
            $post_title = $_POST['post_title'];
            $post_body = $_POST['post_body'];
            $selected_tags = $_POST['selected_tags']; // Recupera as tags selecionadas
            $tag_ids = explode(",", $selected_tags); // Separa as tags em um array
            $func->publication($post_title, $post_body, $tag_ids, $user_id);
            header('pagina_de_resultados.php');
        }
    } else {
        echo " ";
    }


    ?>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: ' codesample',
            toolbar: 'undo redo | blocks fontsize | bold italic underline | |  |   | | checklist numlist bullist  |   | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

    <script>

        var firstTagAdded = true;


        document.querySelectorAll('input[type="checkbox"]').forEach(item => {
            item.addEventListener('change', event => {

                if (event.target.checked) {

                    addToSelectedTags(event.target.value);
                } else {

                    removeFromSelectedTags(event.target.value);
                }
            });
        });


        function addToSelectedTags(tag) {
            var selectedTagsInput = document.getElementById("selectedTagsInput");
            var currentValue = selectedTagsInput.value;
            if (currentValue !== "") {
                currentValue += ",";
            }
            selectedTagsInput.value = currentValue + tag;
        }


        function removeFromSelectedTags(tag) {

            var tags = document.querySelectorAll(".tag");

            tags.forEach(function (tagElement) {
                if (tagElement.textContent === tag) {
                    tagElement.parentNode.removeChild(tagElement);
                }
            });


            if (document.querySelectorAll(".tag").length === 0) {
                firstTagAdded = true;
            }
        }
    </script>

    <script>
        function previewImage(event) {
            var image = document.getElementById('profile-pic');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

</body>

</html>