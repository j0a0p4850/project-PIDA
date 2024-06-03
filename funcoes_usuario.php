<?php

include 'conexao_db.php';


class funcoes
{


    public function registro($fist_name, $last_name, $username, $email, $password)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        
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

    public function atualizarInformacoesUsuario($user_id, $user_description, $habilidades, $habilidade_descricao, $empresa, $cargo)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        
        $user_description = mysqli_real_escape_string($conecta, $user_description);
        $habilidades = mysqli_real_escape_string($conecta, $habilidades);
        $habilidade_descricao = mysqli_real_escape_string($conecta, $habilidade_descricao);
        $empresa = mysqli_real_escape_string($conecta, $empresa);
        $cargo = mysqli_real_escape_string($conecta, $cargo);

        
        $sql = "UPDATE `tb_usuario` SET ";
        if (!empty($user_description)) {
            $sql .= "`descricao_user` = '$user_description', ";
        }
        if (!empty($habilidades)) {
            $sql .= "`habilidade_user` = '$habilidades', ";
        }
        if (!empty($habilidade_descricao)) {
            $sql .= "`habilidade_descricao` = '$habilidade_descricao', ";
        }
        if (!empty($empresa)) {
            $sql .= "`empresa_user` = '$empresa', ";
        }
        if (!empty($cargo)) {
            $sql .= "`cargo_empresa_user` = '$cargo', ";
        }
        // Remover a última vírgula
        $sql = rtrim($sql, ', ');

        $sql .= " WHERE `id_user` = $user_id;";

        // Executar a consulta
        if (mysqli_query($conecta, $sql)) {
            echo "Informações do usuário atualizadas com sucesso!";
        } else {
            echo "Erro ao atualizar informações do usuário: " . mysqli_error($conecta);
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
       
        $sql = "SELECT id_user, descricao_user, habilidade_user, cargo_empresa_user, empresa_user, habilidade_descricao FROM tb_usuario where id_user = '$id_user';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {

                echo '<br>
                <a href="edicao_dados_perfil.php"><button type="button" class="btn btn-primary btn-sm">Editar Informações</button></a>
                <div class="resumo">
                        <h3>Resumo</h3>
                        <p>' . $linha['descricao_user'] . '</p>
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
                                    <th scope="row">' . $linha['empresa_user'] . '</th>
                                    <td>' . $linha['cargo_empresa_user'] . '</td>

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
                                            '.$linha['habilidade_user'] .'
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                        '.$linha['habilidade_descricao'] .'
                                        </div>
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