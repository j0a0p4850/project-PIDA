<?php

include 'conexao_db.php';


class funcoes
{


    public function registro($fist_name, $last_name, $username, $email, $password)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "INSERT INTO `tb_usuario` (`user_first_name`, `user_last_name`,`user_name`, `user_email`, `user_password`) VALUES "
            . "( '$fist_name', '$last_name','$username', '$email', '$password')";
        if ($conecta->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conecta->error . "<br>";
        }
        $conexao->desconectar();
    }
    public function logar($email, $password)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $sql = "SELECT id_user, user_name, user_email FROM tb_usuario WHERE user_password='$password' and user_email='$email'";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            // saída dos dados
            while ($linha = $resultado->fetch_assoc()) {

                return $linha["id_user"];
            }
        } else {
            return FALSE;
        }

        $conexao->desconectar();
    }
    public function display_name($id_user)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT (`user_name`) FROM tb_usuario where id_user = $id_user ";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo '<h3>' . $linha['user_name'] . '</h3>
                ';
            }

        } else {
            echo 'Usuario não possui username';
        }
        $conexao->desconectar();
    }

    public function body_perfil_display($id_user)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT id_user, descricao_user FROM tb_usuario where id_user = '$id_user';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {

                echo '<br>
                <a href="edicao_dados_perfil.php"><button type="button" class="btn btn-primary btn-sm">Editar Informações</button></a>
                <div class="resumo">
                        <h3>Resumo</h3>
                        <p>'.$linha['descricao_user'] .'</p>
                    </div>
                    <br>
                    <br>
                    <div class="profile-section">
                        <h3>Experiência Profissional</h3> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Cargo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="profile-section">
                        <h3>Habilidades <button type="button" id="toggleSkills"
                        class="btn btn-primary btn-sm toggle-icon">🞃</button></h3>
                        <ul class="list-group list-group-flush collapsible collapsed" id="skillsList">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            first items accordion body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            second items accordion body. Lets imagine this being filled with some
                                            actual content.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            third items accordion body. Nothing more exciting happening here in terms
                                            of content, but just filling up the space to make it look, at least at first
                                            glance, a bit more representative of how this would look in a real-world
                                            application.</div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>';

            }

        } else {
            echo 'Não há nenhuma pergunta feita ainda';
        }

        $conexao->desconectar();
    }

}


?>