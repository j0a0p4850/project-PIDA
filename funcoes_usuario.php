<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include 'conexao_db.php';


class funcoes
{


    public function registro($first_name, $last_name, $username, $email, $hashedPassword)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        // Verifica se o email já está em uso
        $checkEmailQuery = "SELECT * FROM tb_usuario WHERE user_email = ?";
        $stmtCheckEmail = $conecta->prepare($checkEmailQuery);
        $stmtCheckEmail->bind_param("s", $email);
        $stmtCheckEmail->execute();
        $resultEmail = $stmtCheckEmail->get_result();

        if ($resultEmail->num_rows > 0) {
            // Email já está em uso
            echo "Erro: Esse email já existe.";
            $stmtCheckEmail->close();
            $conecta->close();
            return;
        }

        // Verifica se o username já está em uso
        $checkUsernameQuery = "SELECT * FROM tb_usuario WHERE user_name = ?";
        $stmtCheckUsername = $conecta->prepare($checkUsernameQuery);
        $stmtCheckUsername->bind_param("s", $username);
        $stmtCheckUsername->execute();
        $resultUsername = $stmtCheckUsername->get_result();

        if ($resultUsername->num_rows > 0) {
            // Username já está em uso
            echo "Erro: Esse user já existe.";
            $stmtCheckUsername->close();
            $conecta->close();
            return;
        }

        // Insere o novo registro
        $stmt = $conecta->prepare("INSERT INTO tb_usuario (user_first_name, user_last_name, user_name, user_email, user_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $hashedPassword);

        $mail = new PHPMailer(true);
        try {
            $mail-> CharSet = 'UTF-8';
            if ($stmt->execute()) {
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = '0c58445a22fa36';
                $mail->Password = '24d6d9aaf85bab';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Timeout = 5;

                $mail->setFrom('techqa.pida@gmail.com', 'TechQA');
                $mail->addAddress($email, $username);

                $mail->isHTML(true);
                $mail->Subject = 'Confirmar Cadastro';
                $mail->Body = "Clique no link para poder confirmar o email e ter acesso a conta <a href='http://localhost:3000/login.php'>Clique Aqui</a>";
                $mail->AltBody = "Clique no link para poder confirmar o email e ter acesso a conta http://localhost:3000/login.php";

                $mail->send();
                echo "Confirme a sua conta pelo email para poder acessa-la";

            } else {
                echo "Erro no cadastro: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $stmt->close();
        $stmtCheckEmail->close();
        $stmtCheckUsername->close();
        $conecta->close();
    }


    public function esquecer_senha($email)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        // Verifica se o email está registrado
        $checkEmailQuery = "SELECT * FROM tb_usuario WHERE user_email = ?";
        $stmtCheckEmail = $conecta->prepare($checkEmailQuery);
        $stmtCheckEmail->bind_param("s", $email);
        $stmtCheckEmail->execute();
        $resultEmail = $stmtCheckEmail->get_result();

        if ($resultEmail->num_rows > 0) {
            // Email está registrado, envia o email de redefinição de senha
            $mail = new PHPMailer(true);
            try {
                $mail-> CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = '0c58445a22fa36';
                $mail->Password = '24d6d9aaf85bab';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Timeout = 5;

                $mail->setFrom('techqa.pida@gmail.com', 'TechQA');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Redefinição de Senha';
                $mail->Body = "Clique no link para poder redefinir sua senha <a href='http://localhost:3000/esqueci_senha.php?id=$email'>Clique Aqui</a>";
                $mail->AltBody = "Clique no link para poder redefinir sua senha http://localhost:3000/esqueci_senha.php";

                $mail->send();
                echo "Um email foi enviado para o endereço fornecido para redefinir sua senha.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Email não está registrado
            echo "Erro: Este email não está registrado.";
        }

        $stmtCheckEmail->close();
        $conecta->close();
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

    public function atualizar_senha($email, $password)
{
    $conexao = new conexaoDB();
    $conecta = $conexao->conectar();

    // Preparar a declaração SQL para evitar injeção de SQL
    $stmt = $conecta->prepare("UPDATE `tb_usuario` SET `user_password` = ? WHERE `user_email` = ?");
    
    // Verificar se a preparação foi bem-sucedida
    if ($stmt === false) {
        echo "Erro ao preparar a consulta: " . $conecta->error;
        return;
    }

    // Vincular os parâmetros
    $stmt->bind_param('ss', $password, $email);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "Senha atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a senha: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conexao->desconectar();
}


    public function logar($email, $password)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $stmt = $conecta->prepare("SELECT id_user, user_password FROM tb_usuario WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_user, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $stmt->close();
                $conecta->close();

                return $id_user;
            } else {
                $stmt->close();
                $conecta->close();

                echo "E-mail ou senha incorretos.";
                return false;
            }
        } else {
            $stmt->close();
            $conecta->close();

            echo "E-mail ou senha incorretos.";
            return false;
        }
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

        $sql = "SELECT id_user, descricao_user, habilidade_user, cargo_empresa_user, empresa_user, habilidade_descricao FROM 
        tb_usuario where id_user = '$id_user';";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {

                echo '<br>
                <a href="edicao_dados_perfil.php"><button type="button" class="btn btn-primary btn-sm">Editar Informações</button></a>
                <br>
                <br>
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
                                            ' . $linha['habilidade_user'] . '
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                        ' . $linha['habilidade_descricao'] . '
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

    public function display_questoes_usuario($id_usuario)
    {


        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();
        // Inserir registro
        $sql = "SELECT p.id_pergunta, p.pergunta_title, p.pergunta_descricao, p.status_pergunta, p.avaliacao_post, p.user_id,
        p.data_publicacao, p.data_fechamento, p.status_pergunta, GROUP_CONCAT(t.tag_name) AS tags_associadas
        FROM tb_pergunta p
        JOIN tb_pergunta_tags pt ON p.id_pergunta = pt.pergunta_id
        JOIN tb_tags t ON pt.tag_id = t.id_tags where p.user_id = $id_usuario
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

}


?>