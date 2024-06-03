<?php

include 'conexao_db.php';

if(isset($_POST["input"])){

    $conexao = new conexaoDB();

    $conecta = $conexao->conectar();

    $input = $_POST["input"];

    $query = "SELECT pergunta_title, data_publicacao FROM tb_pergunta WHERE pergunta_title LIKE '%{$input}%' LIMIT 3";

    $result = mysqli_query($conecta, $query);

    if(mysqli_num_rows($result) > 0){
        ?>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $title = $row['pergunta_title'];
                        $data = $row['data_publicacao'];

                    }
                ?>
                <tr>
                    <td><?php echo $title;?></td>
                    <td><?php echo $data;?></td>
                </tr>
            </tbody>
        </table>

        <?php
    }
    else{
        echo "Data not found";
    }

}





?>