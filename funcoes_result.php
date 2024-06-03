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


    public function publication($post_title, $post_body, $tag_ids, $user_id)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();


        $sql_pergunta = "INSERT INTO `tb_pergunta` (`pergunta_title`, `pergunta_descricao`, `data_publicacao`, `user_id`) VALUES (?, ?, NOW(), ?)";


        $stmt_pergunta = $conecta->prepare($sql_pergunta);
        $stmt_pergunta->bind_param("sss", $post_title, $post_body, $user_id);


        if (!$stmt_pergunta->execute()) {
            echo "Erro ao inserir pergunta: " . $stmt_pergunta->error;
            return;
        }


        $pergunta_id = $stmt_pergunta->insert_id;


        $stmt_pergunta->close();


        $sql_assoc = "INSERT INTO `tb_pergunta_tags` (`pergunta_id`, `tag_id`) VALUES (?, ?)";


        $stmt_assoc = $conecta->prepare($sql_assoc);
        $stmt_assoc->bind_param("ii", $pergunta_id, $tag_id);


        foreach ($tag_ids as $tag_id) {

            if (!$stmt_assoc->execute()) {
                echo "Erro ao inserir registro de associação: " . $stmt_assoc->error;
                return;
            }
        }


        $stmt_assoc->close();

        $conexao->desconectar();

        echo "Postagem enviada com sucesso.";
    }



    public function post_display($id_post, $id_user)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_pergunta, pergunta_title, pergunta_descricao, tag_id, user_id FROM tb_pergunta where id_pergunta = '$id_post';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                echo '<div class="post">
                <div>
                <h2>' . $linha['user_id'] . '</h2>
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

            if (isset($_SESSION["login"]) && $_SESSION["login"] == $linha["user_id"]) {
                echo '<a class="btn btn-danger" href="excluir_postagem.php?postagem_id=' . ($linha['id_pergunta']) . '">
                Excluir Postagem
                </a>';
            }

            echo '</div>';

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }

    public function Answer($resp_body, $id_post, $id_user)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();


        $sql = "INSERT INTO `tb_comentarios` (`comentario_corpo`, `id_pergunta`, `id_user`) VALUES (?, ?, ?)";


        $stmt = $conecta->prepare($sql);


        $stmt->bind_param("sss", $resp_body, $id_post, $id_user);


        if ($stmt->execute()) {
            header("Location: pagina_de_resultados.php");
            exit();
        } else {
            echo "Erro: " . $stmt->error . "<br>";
        }


        $stmt->close();
        $conexao->desconectar();
    }

    public function post_resp($id_post, $id_user)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $sql = "SELECT p.id_pergunta, c.id_comentario, c.comentario_corpo, c.id_user
        FROM tb_pergunta p
        JOIN tb_comentarios c ON p.id_pergunta = c.id_pergunta
        WHERE p.id_pergunta = '$id_post';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                echo '
    <h3>' . ($linha['id_user']) . '</h3>
    <div class="resp">' . ($linha['comentario_corpo']) . '</div>';

                if (isset($_SESSION["login"]) && $_SESSION["login"] == $linha["id_user"]) {
                    echo '<a class="btn btn-danger" href="excluir_processar_comentario.php?comentario_id=' . ($linha['id_comentario']) . '">
                    Excluir
                    </a>';
                }

                echo '</div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }

    public function excluirComentario($comentarioId)
    {

        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        $sql = "DELETE FROM tb_comentarios WHERE id_comentario = '$comentarioId';";
        $conecta->query($sql);
        $conexao->desconectar();


    }

    public function excluir_Post($id_post) {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
    
        // Iniciar transação
        $conecta->begin_transaction();
    
        try {
            // Primeiro, remova os registros relacionados na tabela tb_comentarios
            $sql1 = "DELETE FROM tb_comentarios WHERE id_pergunta = ?";
            $stmt1 = $conecta->prepare($sql1);
            $stmt1->bind_param("i", $id_post);
            $stmt1->execute();
            $stmt1->close();
    
            // Remova os registros relacionados na tabela tb_resposta
            $sql2 = "DELETE FROM tb_resposta WHERE pergunta_id = ?";
            $stmt2 = $conecta->prepare($sql2);
            $stmt2->bind_param("i", $id_post);
            $stmt2->execute();
            $stmt2->close();
    
            // Remova os registros relacionados na tabela tb_pergunta_tags
            $sql3 = "DELETE FROM tb_pergunta_tags WHERE pergunta_id = ?";
            $stmt3 = $conecta->prepare($sql3);
            $stmt3->bind_param("i", $id_post);
            $stmt3->execute();
            $stmt3->close();
    
            // Por fim, remova a pergunta na tabela tb_pergunta
            $sql4 = "DELETE FROM tb_pergunta WHERE id_pergunta = ?";
            $stmt4 = $conecta->prepare($sql4);
            $stmt4->bind_param("i", $id_post);
            $stmt4->execute();
            $stmt4->close();
    
            // Commit a transação
            $conecta->commit();
        } catch (mysqli_sql_exception $exception) {
            // Rollback a transação em caso de erro
            $conecta->rollback();
            throw $exception;
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
                    <h5 class="card-title">' . $linha['tag_name'] . '</h5>
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