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
    <form action="" method="POST">
        <div class="container">
            <div class="header">
                <h1>Titulo</h1>
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Titulo Publicação</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" name="post_title">
                </div>

            </div>
            <div class="content">
                <textarea placeholder="Escreva sua publicação aqui" name="post_body">

                </textarea>
            </div>
            <div class="footer">
                <button type="submit" class="btn btn-success">Salvar Publicação</button>
            </div>
        </div>
    </form>

    <?php
           include 'funcoes_result.php';
          
           $func = new resultados();
           if($_SERVER["REQUEST_METHOD"]=="POST"){
            $post_title = $_POST['post_title'];
            $post_body = $_POST['post_body'];
            
            
           $func->publication($post_title, $post_body);
           }
           
     
        ?>

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