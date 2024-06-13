<?php
session_start();
include "funcoes_result.php";
$func = new resultados();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resp_body = $_POST['resp_body'];
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

    <script src="https://cdn.tiny.cloud/1/7jodojbng5amadhee2m4fr5wh2e1uxbzn8p07lrxngqhu81c/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

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
            width: 1020px;


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
            margin-left: 100px;
            margin-top: 30px;
            width: 700px;
        }

        .area_comentario {
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;

        }


        .container_area_texto {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .area_texto {
            width: 1020px;
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

        .comentario_resp {
            display: contents;
        }
        .botoes{
            margin-left: 16rem;
        }
        .corpo{
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
        h6, h5 {
            color: #333;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
        p {
            color: #666;
        }
        .resp_section{
            margin-left: 10rem;
            width: 50%;
        }
    </style>
</head>

<body>


        <div class="container">
            <?php


            if (isset($_GET['id'])) {
                $id_post = $_GET['id'];
                $func->post_display($id_post);
            }
            ?>
        </div>
    

    <div>
        <?php
        $func = new resultados();
        if (isset($_GET['id']) && isset($_SESSION['login'])) {
            $id_user = $_SESSION['login'];
            $id_post = $_GET['id'];
            $func->post_resp($id_post, $id_user);
        }
        ?>
    </div>

    <div class="resp">

        <div class="container_area_texto">

            <form action="#" method="POST" id="respForm" class="area_texto ">
                <label for="resp">Resposta</label>
                <textarea placeholder="Escreva Sua resposta aqui" id="id_teste" name="resp_body"></textarea>
                <br>
                <button type="submit" class="btn btn-info">Enviar Resposta</button>
            </form>


            <br>


        </div>

        <br>



    </div>

    <script>
        tinymce.init({
            selector: 'textarea#id_teste',
            height: 300,
            menubar: 'insert edit view',
            plugins: 'autolink charmap codesample',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });

        tinymce.init({
            selector: 'textarea#Comentario_resps',
            height: 200,
            plugins: 'autolink charmap codesample searchreplace',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js">
        document.addEventListener('DOMContentLoaded', function () {
            Prism.highlightAll();
        });
    </script>

    <script>
        const incrementBtn = document.getElementById('incrementBtn');
        const decrementBtn = document.getElementById('decrementBtn');


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
                            alert('Valor incrementado com sucesso!');
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


    <script>
        // Função para excluir o comentário via AJAX
        function excluirComentario(comentarioId) {
            $.ajax({
                type: "POST",
                url: "excluir_comentario.php", // Altere o nome do arquivo PHP conforme necessário
                data: { comentarioId: comentarioId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // Exibir a mensagem de sucesso
                        alert(response.message); // Você pode usar um modal ou outra forma de exibição
                        // Aqui você pode atualizar a interface conforme necessário
                    } else {
                        // Exibir mensagem de erro, se necessário
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Lidar com erros de requisição AJAX, se necessário
                    console.error("Erro na requisição AJAX: " + error);
                }
            });
        }

        // Exemplo de uso da função
        // Chame essa função com o ID do comentário que você deseja excluir

    </script>

</body>

</html>