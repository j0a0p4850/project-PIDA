<?php

include 'conexao_db.php';

$conexao = new conexaoDB();
$conecta = $conexao->conectar();

if (isset($_POST["action"])) {
    $query = "
        SELECT p.id_pergunta, p.pergunta_title, p.data_publicacao, p.status_pergunta, p.avaliacao_like, p.avaliacao_dislike, t.tag_name 
        FROM tb_pergunta p 
        INNER JOIN tb_pergunta_tags pt ON p.id_pergunta = pt.pergunta_id 
        INNER JOIN tb_tags t ON pt.tag_id = t.id_tags
        WHERE 1
    ";

    if (isset($_POST["tags"]) && !empty($_POST["tags"])) {
        $tag_filter = implode("','", $_POST["tags"]);
        $query .= " AND pt.tag_id IN('" . $tag_filter . "')";
    }

    if (isset($_POST["status"]) && !empty($_POST["status"])) {
        $status_filter = implode("','", $_POST["status"]);
        $query .= " AND p.status_pergunta = '" . $status_filter . "'";
    }

    if (isset($_POST["data_post"]) && !empty($_POST["data_post"])) {
        $data_filter = $_POST["data_post"];
        $query .= " AND YEAR(p.data_publicacao) = '" . $data_filter . "'";
    }

    $output = '';

    $resultado = $conecta->query($query);
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {

            if ($linha['status_pergunta'] == "Aberta") {
                $output .= '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                    </div>
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">Likes: '.$linha['avaliacao_like'] .'</span>
                    <span class="badge text-bg-primary rounded-pill">Dislikes: '.$linha['avaliacao_dislike'] .'</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tag_name'] . '</span>
                    <span class="badge text-bg-primary"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
            </div>';
            }else{
                $output .= '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">Likes: '.$linha['avaliacao_like'] .'</span>
                    <span class="badge text-bg-primary rounded-pill">Dislikes: '.$linha['avaliacao_dislike'] .'</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tag_name'] . '</span>
                    <span class="badge text-bg-danger"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
                </div>';
            }
        }
    } else {
        $output = '<h3>Não existem perguntas com esses requisitos</h3>';
    }
    echo $output;
}

?>