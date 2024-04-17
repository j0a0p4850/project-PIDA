<?php

include 'conexao_db.php';


class resultados
{

    public function result()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT p.id_pergunta, p.pergunta_title, p.pergunta_descricao, 
        p.data_publicacao, p.data_fechamento, p.status_pergunta, GROUP_CONCAT(t.tag_name) AS tags_associadas
        FROM tb_pergunta p
        JOIN tb_pergunta_tags pt ON p.id_pergunta = pt.pergunta_id
        JOIN tb_tags t ON pt.tag_id = t.id_tags
        GROUP BY p.id_pergunta;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . $linha['data_publicacao'] . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">14</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tags_associadas'] . '</span>
                </a>
                </div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }


    public function publication($post_title, $post_body, $tag_ids)
{
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();

    // Preparar a declaração SQL para inserir a pergunta na tabela tb_pergunta
    $sql_pergunta = "INSERT INTO `tb_pergunta` (`pergunta_title`, `pergunta_descricao`, `data_publicacao`) VALUES (?, ?, NOW())";
    
    // Preparar a declaração para inserir a pergunta
    $stmt_pergunta = $conecta->prepare($sql_pergunta);
    $stmt_pergunta->bind_param("ss", $post_title, $post_body);

    // Executar a declaração para inserir a pergunta
    if (!$stmt_pergunta->execute()) {
        echo "Erro ao inserir pergunta: " . $stmt_pergunta->error;
        return;
    }

    // Obter o ID da pergunta recém-inserida
    $pergunta_id = $stmt_pergunta->insert_id;

    // Fechar a declaração de inserção da pergunta
    $stmt_pergunta->close();

    // Preparar a declaração SQL para inserir os registros na tabela de associação tb_pergunta_tags
    $sql_assoc = "INSERT INTO `tb_pergunta_tags` (`pergunta_id`, `tag_id`) VALUES (?, ?)";
    
    // Preparar a declaração para inserir os registros de associação
    $stmt_assoc = $conecta->prepare($sql_assoc);
    $stmt_assoc->bind_param("ii", $pergunta_id, $tag_id);

    // Iterar sobre os IDs das tags e inserir os registros de associação
    foreach ($tag_ids as $tag_id) {
        // Executar a declaração para inserir o registro de associação
        if (!$stmt_assoc->execute()) {
            echo "Erro ao inserir registro de associação: " . $stmt_assoc->error;
            return;
        }
    }

    // Fechar a declaração de inserção de associação
    $stmt_assoc->close();

    // Fechar a conexão
    $conexao->desconectar();

    echo "Postagem enviada com sucesso.";
}



    public function post_display($id_post)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_pergunta, pergunta_title, pergunta_descricao, tag_id FROM tb_pergunta where id_pergunta = '$id_post';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                echo '<div class="post">
                <div>
                    <header class="cabeca_post"> 
                        <h4>' .
                    $linha['pergunta_title']
                    . '
                        </h4>
                    </header>
                </div>
                <div class="corpo">
                    <pre class="">
                        '
                    .
                    $linha['pergunta_descricao']
                    .
                    '       
                    </pre>
                    <br>
                    ' . $linha['tag_id'] . '
                </div>
            </div>';

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }

    public function Answer($resp_body, $id_post)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        // Preparar a declaração SQL
        $sql = "INSERT INTO `tb_comentarios` (`comentario_corpo`, `id_pergunta`) VALUES (?, ?)";

        // Preparar a declaração
        $stmt = $conecta->prepare($sql);

        // Vincular parâmetros
        $stmt->bind_param("ss", $resp_body, $id_post);

        // Executar a declaração
        if ($stmt->execute()) {
            header("<script>window.location.href = 'pagina_de_post.php';</script>");
            exit();
        } else {
            echo "Erro: " . $stmt->error . "<br>";
        }

        // Fechar a declaração e desconectar
        $stmt->close();
        $conexao->desconectar();
    }

    public function post_resp($id_post)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT p.id_pergunta, c.comentario_corpo
        FROM tb_pergunta p
        JOIN tb_comentarios c ON p.id_pergunta = c.id_pergunta
        WHERE p.id_pergunta = '$id_post';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                echo '<div class="resp"> ' .
                    $linha['comentario_corpo']
                    . '
                </div>';

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }

    public function show_tags()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_tags, tag_name FROM tb_tags;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '<input type="checkbox" name="id_tag" id=' . $linha['id_tags'] . ' value=' . $linha['id_tags'] . '>
                <label for=' . $linha['id_tags'] . '>' . $linha['tag_name'] . '</label>    ';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }

    public function display_tags_pag_tags()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_tags, tag_name FROM tb_tags;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '  <div class="card">
                <div class="card-body">
                    <h5 class="card-title">'.$linha['tag_name'] .'</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }


}
?>