<?php

include 'conexao_db.php';


class resultados
{

    public function result()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_pergunta, pergunta_title, pergunta_descricao FROM tb_pergunta;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '<div class="list-group">
                <a href="pagina_de_post.php?id='.$linha['id_pergunta'].'" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">' . $linha['pergunta_title'] . '</h5>
                        <small>3 days ago</small>
                
                    </div>
                    <p class="mb-1">' . $linha['pergunta_descricao'] . '</p>
                    <small>And some small print.</small>
                    <br>
                    <span class="badge text-bg-primary rounded-pill">14</span>
                </a>
                </div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();




    }


    public function publication($post_title, $post_body)
{
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();

    // Preparar a declaração SQL
    $sql = "INSERT INTO `tb_pergunta` (`pergunta_title`, `pergunta_descricao`) VALUES (?, ?)";

    // Preparar a declaração
    $stmt = $conecta->prepare($sql);
    
    // Vincular parâmetros
    $stmt->bind_param("ss", $post_title, $post_body);

    // Executar a declaração
    if ($stmt->execute()) {
        header("Location: pagina_de_resultados.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error . "<br>";
    }

    // Fechar a declaração e desconectar
    $stmt->close();
    $conexao->desconectar();
}

    public function post_display($id_post)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_pergunta, pergunta_title, pergunta_descricao FROM tb_pergunta where id_pergunta = '$id_post';";
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
                    <pre class="language-php">
                        <code>' 
                            .
                            $linha['pergunta_descricao']
                            . 
                '       </code>
                    </pre>
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