<?php
session_start();
include "funcoes_result.php";
$func = new resultados();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resp_body = $_POST['resp_body'];
    if ($resp_body != '') {
        if (isset($_GET['id'])) {
            if (isset($_SESSION['login'])) {
                $id_user = $_SESSION['login'];
                $id_post = $_GET['id'];
                $func->Answer($resp_body, $id_post, $id_user);
            } else {
                header('Location: login.php');
            }
        } else {
            echo 'Ocorreu algum erro, por favor tente novamente mais tarde';
        }
    } else {
        echo 'Nao registrou nada';
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <style>
        .escondido {
            display: none;
        }

        #confirmationMessage {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            width: 300px;
            margin-top: 20px;
        }

        #confirmationMessage p {
            margin: 0 0 10px 0;
        }

        #confirmationMessage button {
            margin-right: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
        }

        .modal-content button {
            margin-top: 10px;
            margin-right: 10px;
        }

        .post {
            margin-top: 10px;
            height: fit-content;
            max-height: 600px;

            overflow-y: auto;

            border: 1px solid #ccc;

            padding: 10px;

        }

        .coment_bnt {
            margin-top: 13px;
        }

        .area_comentario_texto {
            margin-left: 10rem;
            margin-top: 20px;

        }

        .tox {
            width: 700px;

        }

        .resp {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            height: fit-content;

        }

        .display_resp {

            border: #333 0.5px solid;
            margin-left: 2%;
            width: 80%;
            padding: 20px;
        }

        .botao-div {
            padding-left: 15px;
        }

        .area_texto {
            margin-left: 0px;
            margin-top: 120px;

        }

        .area_texto button:enabled {
            cursor: pointer;
        }

        .coment_bnt_de {
            margin-left: 60px;
        }

        .area_comentario {
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }




        .container_area_texto {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cabeca_post {
            height: fit-content;
            border-bottom: black solid 3px;
        }

        .coment {
            height: fit-content;
        }

        .comenta {
            height: 150px;
            width: 300px;
        }

        .teste {
            height: 300px;
        }

        /*.comentario_resp {
            display: contents;
        }*/

        .botoes {
            margin-left: 6rem;
        }

        .corpo {
            margin-top: 3rem;
        }

        .section {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            position: relative;
        }

        .ql-container.ql-snow {
            height: 10rem;
        }

        .section:first-child {
            margin-top: 40px;
        }

        .section::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            width: 2px;
            height: calc(100% + 20px);
            background-color: #ccc;
            transform: translateX(-50%);
            z-index: -1;
        }

        h6,
        h5 {
            color: #333;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        p {
            color: #666;
        }

        .resp_section {
            margin-left: 7rem;
            width: 70%;
            overflow-y: auto;
            max-height: 300px;


        }

        .post_body {
            margin-top: 30px;
            border: #333 1px solid;
            width: 750px;
        }

        .section_post_total {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buttons {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .buttons a {
            flex: 1;
            margin: 0 5px;
        }

        .like-img {
            height: 30px;

        }

        .bnt-like {
            background-color: transparent;
            /* Remove o fundo do botão */
            border: none;
            /* Remove a borda do botão */
            padding: 0;
            /* Remove o preenchimento interno do botão */
            cursor: pointer;
            float: left;
        }

        #editor-container {
            height: 300px;
        }

        .bnt-dislike {
            margin-left: 5px;
            border: none;
            cursor: pointer;
            background-color: transparent;
            height: auto;
            transform: rotateX(180deg);
        }

        .search-container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            position: relative;
            /* Add position relative */
        }

        .search-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 7px 0 0 7px;
            /* Rounded corners for the left side */
        }

        .search-button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            background-color: #007bff;
            color: white;
            border-radius: 0 7px 7px 0;
            /* Rounded corners for the right side */
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-left: none;
            /* Remove the left border to make it seamless */
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
            width: 100%;
            /* Make suggestions container same width as search container */
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }

        .Titu {
            margin-top: 5rem;
            margin-left: 3rem;
        }
    </style>
</head>

<body>

    <header>
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
    </header>

    <section class="section_post_total">
        <section class="post_body">
            <div class="container">
                <?php


                if (isset($_GET['id'])) {
                    $id_post = $_GET['id'];
                    $func->post_display($id_post);
                }
                ?>
            </div>


            <div>

                <h3 class="Titu">Respostas</h3>
                <?php
                $func = new resultados();
                if (isset($_GET['id']) && isset($_SESSION['login'])) {
                    $id_user = $_SESSION['login'];
                    $id_post = $_GET['id'];
                    $func->post_resp($id_post, $id_user);
                }
                ?>
            </div>
        </section>

    </section>



    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js">
        document.addEventListener('DOMContentLoaded', function () {
            Prism.highlightAll();
        });
    </script>

    <!--INCREMENTO DE VOTO-->
    <script>
        const incrementBtn = document.getElementById('incrementBtn');


        function incrementCounter() {
            const idPost = new URLSearchParams(window.location.search).get('id');
            console.log('ID do Post:', idPost);

            if (idPost) {
                fetch('increment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(idPost)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Resposta do servidor:', data);
                        if (data.status === 'success') {
                            alert('Curtida registrada');
                        } else {
                            alert('Erro ao incrementar valor: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            } else {
                console.error('ID do Post não encontrado na URL');
            }
        }



        incrementBtn.addEventListener('click', incrementCounter);

    </script>

    <script>
        const decrementBtn = document.getElementById('decrementBtn');

        function decrementCounter() {
            const idPost = new URLSearchParams(window.location.search).get('id');
            console.log('ID do Post:', idPost);

            if (idPost) {
                fetch('decrement.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(idPost)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Resposta do servidor:', data);
                        if (data.status === 'success') {
                            alert('Descurtida registrada');
                        } else {
                            alert('Erro ao decrementar valor: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            } else {
                console.error('ID do Post não encontrado na URL');
            }
        }

        decrementBtn.addEventListener('click', decrementCounter);
    </script>


    <!--MODAL PARA DENUNCIA-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelButton = document.getElementById('cancelButton');
            const confirmationMessage = document.getElementById('confirmationMessage');
            const confirmCancelButton = document.getElementById('confirmCancelButton');
            const dismissMessageButton = document.getElementById('dismissMessageButton');

            cancelButton.addEventListener('click', function () {
                confirmationMessage.classList.remove('escondido');
            });

            confirmCancelButton.addEventListener('click', function () {

                confirmationMessage.classList.add('escondido');
                console.log('Cancelled');
            });

            dismissMessageButton.addEventListener('click', function () {
                confirmationMessage.classList.add('escondido');
            });

            const reportButtons = document.querySelectorAll('.reportButton');
            const reportModals = document.querySelectorAll('.reportModal');
            const otherCheckboxes = document.querySelectorAll('.otherCheckbox');
            const otherReasonInputs = document.querySelectorAll('.otherReasonInput');
            const cancelReportButtons = document.querySelectorAll('.cancelReportButton');

            reportButtons.forEach((button, index) => {
                button.addEventListener('click', function () {
                    reportModals[index].classList.remove('escondido');
                });

                otherCheckboxes[index].addEventListener('change', function () {
                    if (otherCheckboxes[index].checked) {
                        otherReasonInputs[index].style.display = 'block';
                    } else {
                        otherReasonInputs[index].style.display = 'none';
                    }
                });

                cancelReportButtons[index].addEventListener('click', function () {
                    reportModals[index].classList.add('escondido');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const reportButtons = document.querySelectorAll('.reportButton');
            const cancelReportButtons = document.querySelectorAll('.cancelReportButton');

            reportButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const postId = button.nextElementSibling.id.split('_')[1];
                    document.getElementById(`reportModal_${postId}`).classList.remove('escondido');
                });
            });

            cancelReportButtons.forEach(button => {
                button.addEventListener('click', function () {
                    button.closest('.reportModal').classList.add('escondido');
                });
            });
        });
    </script>

    <!--EXCLUSÃO DE COMENTARIO-->
    <script>

        function excluirComentario(comentarioId) {
            $.ajax({
                type: "POST",
                url: "excluir_comentario.php",
                data: { comentarioId: comentarioId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        alert(response.message);

                    } else {

                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {

                    console.error("Erro na requisição AJAX: " + error);
                }
            });
        }



    </script>

    <!--EXCLUSÃO DE POST-->
    <script>
        $(document).ready(function () {
            $('.delete-post').click(function () {
                var postId = $(this).data('post-id');
                $.ajax({
                    url: 'excluir_post.php',
                    type: 'GET',
                    data: { postagem_id: postId },
                    success: function (response) {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.status === 'success') {
                            alert(jsonResponse.message);
                            location.reload(); // Atualiza a página
                        } else {
                            alert(jsonResponse.message);
                        }
                    },
                    error: function () {
                        alert('Erro ao excluir o post.');
                    }
                });
            });
        });
    </script>

    <!--CONFIRMAÇÃO CANCELAR-->
    <script>

        function toggleCommentForm(comentarioId) {
            var commentForm = document.getElementById('commentForm_' + comentarioId);
            if (commentForm.style.display === 'none') {
                commentForm.style.display = 'block';
            } else {
                commentForm.style.display = 'none';
            }
        }


        function confirmDelete(id, tipo) {
            var mensagem = (tipo === 'comentario') ? 'Tem certeza que deseja excluir este comentário?' : 'Tem certeza que deseja excluir esta resposta?';
            if (confirm(mensagem)) {
                if (tipo === 'comentario') {
                    window.location.href = 'excluir_processar_comentario.php?comentario_id=' + id;
                } else if (tipo === 'resposta') {
                    window.location.href = 'excluir_processar_resp.php?resp_id=' + id;
                }
            }
        }
    </script>

    <!--BARRA DE PESQUISA-->
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

    <!--EDITOR DE TEXTO-->
    <script>
        var quill = new Quill('#editor-container-resposta', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                    [{ size: [] }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    ['code', 'link'],
                    ['clean']
                ]
            }
        });

        var quillComentario = new Quill('#editor-container-comentario', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                    [{ size: [] }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    ['code', 'link'],
                    ['clean']
                ]
            }
        });

        function prepareSubmissionComent() {
            var postBody = document.querySelector('input[name=comment_body]');
            postBody.value = quillComentario.root.innerHTML.trim();
        }

        function prepareSubmission() {
            var postBody = document.querySelector('input[name=resp_body]');
            postBody.value = quill.root.innerHTML.trim();
        }
    </script>




</body>

</html>