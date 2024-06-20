<?php
session_start();
include 'funcoes_result.php';
$func = new resultados();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['login'];
        $post_title = $_POST['post_title'];
        $post_body = $_POST['post_body'];
        $selected_tags = $_POST['selected_tags']; // Recupera as tags selecionadas
        $tag_ids = explode(",", $selected_tags); // Separa as tags em um array

        // Chama a função para inserir a pergunta e obter o ID inserido
        $pergunta_id = $func->publication($post_title, $post_body, $tag_ids, $user_id);

        if ($pergunta_id) {
            // Redireciona para a página da pergunta utilizando o ID retornado
            header("Location: pagina_de_post.php?id=$pergunta_id");
            exit;
        } else {
            echo "Erro ao processar a publicação da pergunta.";
        }
    }
} else {
    echo " ";
}
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
        pre{
            background-color: gray;
        }

        #editor-container {
            height: 300px;
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

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
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
                    <li class="nav-item">
                        <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                    </li>
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
            </div>
        </div>
    </nav>
    <br>
    <br>

    <form action="" method="POST" enctype="multipart/form-data" onsubmit="prepareSubmission()">
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
                <h3>Escreva aqui</h3>
                <div id="editor-container"></div>
                <input type="hidden" name="post_body" id="post_body">
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

    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                    [{ size: [] }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' },
                    { 'indent': '-1' }, { 'indent': '+1' }],
                    ['code', 'link'],
                    ['clean']
                ]
            }
        });

        function prepareSubmission() {
            var postBody = document.querySelector('input[name=post_body]');
            postBody.value = quill.root.innerHTML;
        }
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

    

</body>

</html>
