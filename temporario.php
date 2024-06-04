<?php

include "conexao_db.php";

$conexao = new conexaoDB();
$conecta = $conexao->conectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importar jQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Importar jQuery UI 1.13.3 -->
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>

    <!-- Importar o CSS do jQuery UI 1.13.3 -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <br />
            <br />
            <div class="col-md-3">
                <div class="list-group">
                    <h3>Tags</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php
                        $query = "SELECT id_tags, tag_name FROM tb_tags;";
                        $resultado = $conecta->query($query);
                        if ($resultado->num_rows > 0) {
                            while ($linha = $resultado->fetch_assoc()) {
                                echo '<input class="common_selector tags" type="checkbox" name="tags" id=' . $linha['id_tags'] . 
                                ' value=' . $linha['id_tags'] . '>
                                <label for=' . $linha['id_tags'] . '>' . $linha['tag_name'] . '</label><br>';
                            }
                        }
                        ?>
                    </div>

                    <h3>Status</h3>
                    <div id="status" style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <input class="common_selector status" type="checkbox" name="status" id="abertos" value="Aberta">
                        <label for="abertos">Abertos</label><br>
                        <input class="common_selector status" type="checkbox" name="status" id="fechados" value="Fechada">
                        <label for="fechados">Fechadas</label><br>
                    </div>

                    <h4>Data</h4>
                    <select name="data_post" id="data_post" class="common_selector">
                        <option value="">Escolha a data</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>

                    <button id="reset_filters" class="btn btn-secondary">Resetar Filtros</button>

                </div>
            </div>
            <div class="col-md-9">
                <div class="filter_data"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var tags = get_filter('tags');
                var status = get_filter('status');
                var data_post = $('#data_post').val();
                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: { action: action, tags: tags, status: status, data_post: data_post },
                    success: function (data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function () {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').on('click change', function () {
                filter_data();
            });

            $('#reset_filters').click(function () {
                $('.common_selector').prop('checked', false);
                $('#data_post').val('');
                filter_data();
            });
        });
    </script>
</body>

</html>
