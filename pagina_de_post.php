<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/7jodojbng5amadhee2m4fr5wh2e1uxbzn8p07lrxngqhu81c/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <style>
        .post {
            margin-top: 10px;
            height: 600px;
            width: 1020px;
            border: beige 10px solid;
        }

        .resp {
            margin-top: 10px;

            width: 1020px;
            height: 350px;
            border: rebeccapurple 10px solid;
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
            height: 100px;
        }

        .coment {
            height: 300px;
        }

        .comenta {
            height: 150px;
            width: 300px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php

            include "funcoes_result.php";

            $func = new resultados();
            
            $func = $func->post_display();


        ?>

        <div class="resp">
            ops
            <br>
            <div class="coment">

                <label for="comentario">Comentario</label>
                <br>
                <input type="text" id="comentario" class="comenta">
            </div>
        </div>
    </div>
    <br>
    <div class="container_area_texto">
        <form action="#">
            <div class="area_texto">
                <textarea placeholder="Escreva Sua resposta aqui">

                </textarea>
            </div>
            <br>
            <button type="button" class="btn btn-danger">Botao</button>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons  link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags |  | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

</body>

</html>