<?php

include "conexao_db.php";

$conexao = new conexaoDB();
$conecta = $conexao->conectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
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
                <!--<div class="list-group">
                    <h3>Price</h3>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                    <div id="price_range"></div>
                </div>-->
                <div class="list-group">
                    <h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php

                        //WHERE product_status = '1'
                        $query = "SELECT id_tags, tag_name FROM tb_tags;";
                        //$statement = $conecta->prepare($query);
                        //$statement->execute();
                        //$result = $statement->get_result();
                        //$perguntas = $result->fetch_all(MYSQLI_ASSOC);
                        $resultado = $conecta->query($query);
                        if ($resultado->num_rows > 0) {
                            while ($linha = $resultado->fetch_assoc()) {

                                echo '<input class = "common_selector brand" type="checkbox" name="id_tag" id=' . $linha['id_tags'] . ' value=' . $linha['id_tags'] . '>
                                <label for=' . $linha['id_tags'] . '>' . $linha['tag_name'] . '</label>    ';

                            }
                        }
                        ?>

                    </div>
                </div>



                <script>
                    $(document).ready(function () {

                        filter_data();

                        function filter_data() {
                            $('.filter_data').html('<div id="loading" style="" ></div>');
                            var action = 'fetch_data';
                            //var brand = get_filter('brand');
                            //var ram = get_filter('ram');
                            //var storage = get_filter('storage');
                            $.ajax({
                                url: "fetch_data.php",
                                method: "POST",
                                data: { action: action },
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

                        $('.common_selector').click(function () {
                            filter_data();
                        });

                        $('#price_range').slider({
                            range: true,
                            min: 1000,
                            max: 65000,
                            values: [1000, 65000],
                            step: 500,
                            stop: function (event, ui) {
                                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                                $('#hidden_minimum_price').val(ui.values[0]);
                                $('#hidden_maximum_price').val(ui.values[1]);
                                filter_data();
                            }
                        });

                    });
                </script>


</body>

</html>