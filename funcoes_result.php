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
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
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
        // Inserir registro
        $sql = "INSERT INTO `tb_pergunta` (`pergunta_title`, `pergunta_descricao`) VALUES "
            . "( '$post_title', '$post_body')";
        if ($conecta->query($sql) === TRUE) {
            header("Location: pagina_de_resultados.php");
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conecta->error . "<br>";
        }
        $conexao->desconectar();
    }

    public function post_display()
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_pergunta, pergunta_title, pergunta_descricao FROM tb_pergunta where id_pergunta = 4;";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '<div class="post">
                <div>
                    <header class="cabeca_post">' .
                    $linha['pergunta_title']
                    . '</header>
                </div>
                <div class="corpo">' .
                    $linha['pergunta_descricao']
                    . '</div>
            </div>';
            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }


}
?>