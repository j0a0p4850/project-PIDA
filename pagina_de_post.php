<?php
session_start();
include "funcoes_result.php";
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
        .post {
            margin-top: 10px;
            height: fit-content;
            width: 1020px;
            border-bottom: black 3px solid;
        }

        .resp {
            margin-top: 10px;

            width: 1020px;
            height: fit-content;
            border-bottom: black 3px solid;
        }

        .container {
            display: flex;
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
    </style>
</head>

<body>

    <div class="container">
        <?php
        $func = new resultados();

        if (isset($_GET['id'])) {
            
            $id_post = $_GET['id'];
            $func->post_display($id_post);
        }
        ?>
        <button id="incrementBtn">Aumentar</button>
        <button id="decrementBtn">Diminuir</button>

        <?php


        $func = new resultados();
        if (isset($_GET['id']) && isset($_SESSION['login'])) {
            $id_user = $_SESSION['login'];
            $id_post = $_GET['id'];
            $func->post_resp($id_post, $id_user);
        }

        ?>

        <div class="resp">

            <div class="container_area_texto">

                <form action="#" method="POST" id="respForm" class="area_texto hidden">
                    <label for="resp">Resposta</label>
                    <textarea placeholder="Escreva Sua resposta aqui" id="id_teste" name="resp_body"></textarea>
                    <br>
                    <button type="submit" class="btn btn-info">Botao</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $resp_body = $_POST['resp_body'];
                    if (isset($_GET['id']) && isset($_SESSION['login'])) {
                        $id_user = $_SESSION['login'];
                        $id_post = $_GET['id'];
                        $func->Answer($resp_body, $id_post, $id_user);
                    }



                }


                ?>
                <br>


            </div>

            <br>


            <div class="container_area_texto" id="commentForm" class="area_texto hidden">
                <form action="comentario" id="comentForm" class="area_texto hidden">
                    <div class="area_texto">
                        <textarea id="Comentario_resps" placeholder="Escreva o comentario aqui "></textarea>
                    </div>
                    <br>
                    <button type="button" class="btn btn-danger">Enviar</button>
                </form>


                <!-- Dando erro -->
                <?php

                //if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //$coment = $_POST['coment'];
                //if (isset($_GET['id'])) {
                //$id_post = $_GET['id'];
                //$func->Answer($coment, $id_post, $resposta);
                //}
                //}
                

                ?>
            </div>
        </div>
    </div>

    <script>
        tinymce.init({
            selector: 'textarea#id_teste',
            height: 300,
            menubar: 'insert edit view',
            plugins: ' autolink charmap codesample',
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
            plugins: ' autolink charmap codesample  searchreplace ',
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

    // Função para enviar a requisição AJAX de incremento
    function incrementCounter() {
        const idPost = new URLSearchParams(window.location.search).get('id');
        console.log('ID do Post:', idPost); // Log de depuração

        if (idPost) {
            fetch('increment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Tipo de conteúdo
                },
                body: 'id=' + encodeURIComponent(idPost) // Enviar dados no formato correto
            })
            .then(response => response.json())
            .then(data => {
                console.log('Resposta do servidor:', data); // Log de depuração
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

    // Adicionando evento ao botão de incremento
    incrementBtn.addEventListener('click', incrementCounter);
</script>



</body>

</html>