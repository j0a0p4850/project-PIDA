<?php

include 'conexao_db.php';


class resultados
{

    public function result()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT p.id_pergunta, p.pergunta_title, p.pergunta_descricao, p.status_pergunta, p.avaliacao_post,
        p.data_publicacao, p.data_fechamento, p.status_pergunta, GROUP_CONCAT(t.tag_name) AS tags_associadas
        FROM tb_pergunta p
        JOIN tb_pergunta_tags pt ON p.id_pergunta = pt.pergunta_id
        JOIN tb_tags t ON pt.tag_id = t.id_tags
        GROUP BY p.id_pergunta;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                if ($linha['status_pergunta'] == "Aberta") {

                    echo '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill"> Likes: ' . $linha['avaliacao_post'] . '</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tags_associadas'] . '</span>
                    <span class="badge text-bg-primary"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
                </div>';
                } else {
                    echo '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">Likes: ' . $linha['avaliacao_post'] . '</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tags_associadas'] . '</span>
                    <span class="badge text-bg-danger"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
                </div>';

                }

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }

    public function result_tags_especifico($id_tags)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT p.id_pergunta, p.pergunta_title, p.pergunta_descricao, p.status_pergunta, p.avaliacao_post,
        p.data_publicacao, p.data_fechamento, p.status_pergunta, GROUP_CONCAT(t.tag_name) AS tags_associadas
        FROM tb_pergunta p
        JOIN tb_pergunta_tags pt ON p.id_pergunta = pt.pergunta_id
        JOIN tb_tags t ON pt.tag_id = t.id_tags WHERE t.id_tags IN ($id_tags)
        GROUP BY p.id_pergunta;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                if ($linha['status_pergunta'] == "Aberta") {

                    echo '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill"> Likes: ' . $linha['avaliacao_post'] . '</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tags_associadas'] . '</span>
                    <span class="badge text-bg-primary"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
                </div>';
                } else {
                    echo '<div class="list-group">
                <a href="pagina_de_post.php?id=' . $linha['id_pergunta'] . '" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>' . date("d/m/Y", strtotime($linha['data_publicacao'])) . '</small>
                
                    </div>
                   
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">Likes: ' . $linha['avaliacao_post'] . '</span>
                    <span class="badge text-bg-primary rounded-pill">' . $linha['tags_associadas'] . '</span>
                    <span class="badge text-bg-danger"> Status: ' . $linha['status_pergunta'] . '</span>
                </a>
                </div>';

                }

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }




    public function fechar_post($id_post)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $sql = "UPDATE tb_pergunta SET status_pergunta = 'Fechada' WHERE id_pergunta = $id_post";

        $conecta->query($sql);
        $conexao->desconectar();
    }


    public function publication($post_title, $post_body, $tag_ids, $user_id)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();


        $sql_pergunta = "INSERT INTO `tb_pergunta` (`pergunta_title`, `pergunta_descricao`, `data_publicacao`, `user_id`, `status_pergunta`, `avaliacao_post`) 
        VALUES (?, ?, NOW(), ?, 'Aberta', 0)";


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



    public function post_display($id_post)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "
    SELECT 
        p.id_pergunta, 
        u.user_name, 
        p.pergunta_title, 
        p.pergunta_descricao, 
        p.tag_id, 
        p.user_id, 
        p.status_pergunta, 
        p.avaliacao_post
    FROM 
        tb_pergunta p
    INNER JOIN 
        tb_usuario u ON p.user_id = u.id_user
    WHERE 
        p.id_pergunta = '$id_post';
    ";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {


                echo '<div class="post">
                <div>
                <a href="perfil_usuario_alt.php?id=' . $linha['user_id'] . '" target="_blank"><h2>' . $linha['user_name'] . '</h2></a>
                    <header class="cabeca_post">
                    <div id="counter">' . $linha['avaliacao_post'] . '</div>
                    <button class="reportButton">Denunciar</button>
                    

                    <div id="reportModal_' . $linha['id_pergunta'] . '" class="reportModal escondido">
                        <div class="modal-content">
                            <h2>Report Post</h2>
                            <p>Select the reason for reporting this post:</p>
                            <form action="process_report.php" id="reportForm_' . $linha['id_pergunta'] . '" method="POST">
                                <label><input type="checkbox" name="reason[]" value="Spam"> Spam</label><br>
                                <label><input type="checkbox" name="reason[]" value="Inappropriate Content"> Inappropriate Content</label><br>
                                <label><input type="checkbox" name="reason[]" value="Harassment"> Harassment</label><br>
                                <label><input type="checkbox" name="reason[]" value="Other" class="otherCheckbox"> Other</label><br>
                                <input type="text" class="otherReasonInput" name="otherReason" placeholder="Please describe the reason">

                                <input type="hidden" name="id_pergunta" value="' . $linha['id_pergunta'] . '">
                                <button type="submit" class="submitReportButton">Submit</button>
                                <button type="button" class="cancelReportButton">Cancel</button>
                            </form>
                        </div>
                    </div>
                        <h4>' .
                    $linha['pergunta_title']
                    . '
                        </h4>
                        <button id="incrementBtn">Curtir</button>
                        <button id="decrementBtn">Descurtir</button>
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
                
            </div>
            ';

                if (isset($_SESSION["login"]) && $_SESSION["login"] == $linha["user_id"]) {
                    if ($linha['status_pergunta'] == 'Aberta') {
                        echo '<a class="btn btn-danger" href="excluir_postagem.php?postagem_id=' . ($linha['id_pergunta']) . '">
                        Excluir Postagem
                        </a>
                        <a class="btn btn-danger" href="fechar_post_process.php?postagem_fech_id=' . ($linha['id_pergunta']) . '">
                        Fechar Postagem
                        </a>
                        <a class="btn btn-danger" href="edit_post.php?postagem_edit_id=' . ($linha['id_pergunta']) . '">
                        Editar Postagem
                        </a>';
                    } else {
                        echo '<a class="btn btn-danger" href="excluir_postagem.php?postagem_id=' . ($linha['id_pergunta']) . '">
                        Excluir Postagem
                        </a>
                        <a class="btn btn-danger" href="edit_post.php?postagem_edit_id=' . ($linha['id_pergunta']) . '">
                        Editar Postagem
                        </a>';
                    }
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

    public function inserir_comentarios($comment_body, $id_user, $resp_id)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();


        $sql = "INSERT INTO `tb_resposta` (`resposta_descricao`, `pergunta_id`, `user_id`, `id_comentario`, `data_publicacao`) VALUES (?, ?, ?, ?, NOW())";


        $stmt = $conecta->prepare($sql);


        $stmt->bind_param("ssss", $comment_body, $id_post, $id_user, $resp_id);


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
    
        $sql = "SELECT p.id_pergunta, 
       c.id_comentario, 
       c.comentario_corpo, 
       c.id_user AS comentario_user_id,
       r.id_resposta,
       r.resposta_descricao,
       r.user_id AS resposta_user_id,
       u.user_name AS comentario_user_name,
       u2.user_name AS resposta_user_name
FROM tb_pergunta p
JOIN tb_comentarios c ON p.id_pergunta = c.id_pergunta
JOIN tb_usuario u ON c.id_user = u.id_user
LEFT JOIN tb_resposta r ON c.id_comentario = r.id_comentario
LEFT JOIN tb_usuario u2 ON r.user_id = u2.id_user
WHERE p.id_pergunta = '$id_post';";
        $resultado = $conecta->query($sql);
    
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
    
                echo '
                <div class="display_resp">
                    <h3>' . ($linha['comentario_user_name']) . '</h3>
                    <button class="reportButton">Denunciar</button> 
                    <div class="resp">' . ($linha['comentario_corpo']) . '
                    ';
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == $linha["comentario_user_id"]) {
                        echo '
                        <a class="btn btn-danger" href="excluir_processar_comentario.php?comentario_id=' . ($linha['id_comentario']) . '">
                            Excluir
                        </a>
                        <a class="btn btn-danger" href="edit_comentario_pag.php?comentario_edicao_id=' . ($linha['id_comentario']) . '">
                            Editar
                        </a>';
                        
                    }
                   echo' <button id="incrementBtn">Curtir</button>
                <button id="decrementBtn">Descurtir</button>
                </div>
                    
                    <div class="resp">
                    <h3>comentario</h3>' . ($linha['resposta_descricao']) . '';
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == $linha["comentario_user_id"]) {
                        echo '
                        <a class="btn btn-danger" href="excluir_processar_resp.php?resp_id=' . ($linha['id_resposta']) . '">
                            Excluir
                        </a>';
                    }
                    
                   echo '</div>';
                    
    
                
    
                echo '
                
    
                <div class="area_comentario" id="commentForm">
                    <form action="process_comentario.php" id="comentForm_'.$linha['id_comentario'].'" class="area_texto" method="POST">
                    <input type="hidden" name="id" value="'.$linha['id_comentario'].'">
                        <div class="area_texto">
                            <textarea id="Comentario_resps" placeholder="Escreva o comentario aqui" name="comment_body"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger">Comentar</button>
                    </form>
                </div>
            </div>';
            }
        } else {
            echo " ";
        }
    
        $conexao->desconectar();
    }
    

    public function excluirComentario($comentarioId)
{
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();

    // Iniciar a transação
    $conecta->begin_transaction();

    try {
        // Excluir a resposta associada ao comentário, se existir
        $sqlDeleteResposta = "DELETE FROM tb_resposta WHERE id_comentario = ?";
        $stmtDeleteResposta = $conecta->prepare($sqlDeleteResposta);
        if ($stmtDeleteResposta === false) {
            throw new Exception('Erro na preparação do statement para excluir resposta: ' . $conecta->error);
        }

        $stmtDeleteResposta->bind_param("i", $comentarioId);
        if (!$stmtDeleteResposta->execute()) {
            throw new Exception('Erro na execução do statement para excluir resposta: ' . $stmtDeleteResposta->error);
        }

        // Não precisamos verificar $stmtDeleteResposta->affected_rows aqui porque a exclusão pode falhar se não houver resposta associada

        // Excluir o comentário
        $sqlDeleteComentario = "DELETE FROM tb_comentarios WHERE id_comentario = ?";
        $stmtDeleteComentario = $conecta->prepare($sqlDeleteComentario);
        if ($stmtDeleteComentario === false) {
            throw new Exception('Erro na preparação do statement para excluir comentário: ' . $conecta->error);
        }

        $stmtDeleteComentario->bind_param("i", $comentarioId);
        if (!$stmtDeleteComentario->execute()) {
            throw new Exception('Erro na execução do statement para excluir comentário: ' . $stmtDeleteComentario->error);
        }

        // Verificar se a exclusão do comentário foi bem-sucedida
        if ($stmtDeleteComentario->affected_rows > 0) {
            // Confirmar a transação
            $conecta->commit();
            echo "Comentário e resposta associados (se houver) excluídos com sucesso.";
        } else {
            // Rolback da transação em caso de falha na exclusão do comentário
            $conecta->rollback();
            echo "Falha ao excluir o comentário.";
        }
    } catch (Exception $e) {
        // Em caso de exceção, rolar para trás a transação
        $conecta->rollback();
        echo "Erro ao excluir o comentário e a resposta: " . $e->getMessage();
    } finally {
        // Fechar os statements se foram inicializados
        if (isset($stmtDeleteResposta)) {
            $stmtDeleteResposta->close();
        }
        if (isset($stmtDeleteComentario)) {
            $stmtDeleteComentario->close();
        }

        // Desconectar
        $conexao->desconectar();
    }
}


    public function excluirResposta($resp_id)
    {

        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        $sql = "DELETE FROM tb_resposta WHERE id_resposta = '$resp_id';";
        $conecta->query($sql);
        $conexao->desconectar();


    }

    public function excluir_Post($id_post)
    {
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
                echo '<input class="common_selector tags" type="checkbox" name="id_tag" id=' . $linha['id_tags'] . ' value=' . $linha['id_tags'] . '>
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
                    <a href="pag_perguntas_tags.php?id= ' . $linha['id_tags'] . '" class="btn btn-primary">Perguntas Com Essa Tag</a>
                </div>
            </div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }

    public function incrementValue($id_post, $id_user)
    {

        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $sql = "UPDATE tb_pergunta SET avaliacao_post = avaliacao_post + 1 WHERE id_pergunta = ?";
        $stmt = $conecta->prepare($sql);
        $stmt->bind_param('i', $id_post);

        if ($stmt->execute()) {
            $stmt->close();
            $conecta->close();
            return true;
        } else {
            $stmt->close();
            $conecta->close();
            return false;
        }
    }

    /* public function editar_post($post_id, $post_title, $pergunta_descricao){

         $conexao = new conexaoDB();
         $conecta = $conexao->conectar();

         $sql = "UPDATE `tb_usuario` SET ";
         if (!empty($post_title)) {
             $sql .= "`pergunta_title` = '$post_title', ";
         }
         if (!empty($pergunta_descricao)) {
             $sql .= "`pergunta_descricao` = '$pergunta_descricao', ";
         }
         
         // Remover a última vírgula
         $sql = rtrim($sql, ', ');

         $sql .= " WHERE `id_pergunta` = $post_id;";

         // Executar a consulta
         if (mysqli_query($conecta, $sql)) {
             echo "Informações do usuário atualizadas com sucesso!";
         } else {
             echo "Erro ao atualizar informações do usuário: " . mysqli_error($conecta);
         }

         $conexao->desconectar();
     }*/
    public function editar_post($post_id, $post_title, $pergunta_descricao)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $sql = "UPDATE `tb_pergunta` SET ";
        $params = [];
        $types = "";

        if (!empty($post_title)) {
            $sql .= "`pergunta_title` = ?, ";
            $params[] = $post_title;
            $types .= "s";
        }
        if (!empty($pergunta_descricao)) {
            $sql .= "`pergunta_descricao` = ?, ";
            $params[] = $pergunta_descricao;
            $types .= "s";
        }

        // Remover a última vírgula
        $sql = rtrim($sql, ', ');

        $sql .= " WHERE `id_pergunta` = ?";
        $params[] = $post_id;
        $types .= "i";

        $stmt = $conecta->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo "Informações do usuário atualizadas com sucesso!";
        } else {
            echo "Erro ao atualizar informações do usuário: " . $stmt->error;
        }

        $stmt->close();
        $conexao->desconectar();
    }

    public function editar_comentario($coment_id, $comentario_corpo)
{
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();

    $sql = "UPDATE `tb_comentarios` SET `comentario_corpo` = ? WHERE `id_comentario` = ?";
    
    $stmt = $conecta->prepare($sql);
    if (!$stmt) {
        echo "Erro ao preparar a consulta: " . $conecta->error;
        return;
    }

    $stmt->bind_param('si', $comentario_corpo, $coment_id);

    if ($stmt->execute()) {
        echo "Informações do comentário atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar informações do comentário: " . $stmt->error;
    }

    $stmt->close();
    $conexao->desconectar();
}




}
?>