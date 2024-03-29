<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Tags</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos para as tags selecionadas */
        .tag {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <form id="checkboxForm" action="" method="post">
        <label><input type="checkbox" name="tags[]" value="Tag 1"> Tag 1</label>
        <label><input type="checkbox" name="tags[]" value="Tag 2"> Tag 2</label>
        <label><input type="checkbox" name="tags[]" value="Tag 3"> Tag 3</label>
        <label><input type="checkbox" name="tags[]" value="Tag 4"> Tag 4</label>
        <button type="submit">Enviar</button>
    </form>

    <div id="tagsContainer">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset ($_POST['tags']) && is_array($_POST['tags'])) {
                $tags = $_POST['tags'];
                // Retorna as tags selecionadas em formato JSON
                echo json_encode($tags);
            } else {
                echo json_encode(array());
            }
        } else {
            echo "Acesso inválido.";
        }
        ?>


    </div>

    <script src="script.js">
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("checkboxForm");
            const tagsContainer = document.getElementById("tagsContainer");

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Evita que o formulário seja enviado da maneira padrão

                const formData = new FormData(this);

                // Envia os dados do formulário para o PHP usando AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "processar.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const tags = JSON.parse(xhr.responseText);
                        showTags(tags);
                    }
                };
                xhr.send(formData);
            });

            function showTags(tags) {
                tagsContainer.innerHTML = ""; // Limpa o conteúdo anterior

                tags.forEach(function (tag) {
                    const tagElement = document.createElement("div");
                    tagElement.className = "tag";
                    tagElement.textContent = tag;
                    tagsContainer.appendChild(tagElement);
                });
            }
        });

    </script>
</body>

</html>