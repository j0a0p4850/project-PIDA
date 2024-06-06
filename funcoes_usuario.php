<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include 'conexao_db.php';


class funcoes
{


    public function registro($fist_name, $last_name, $username, $email, $hashedPassword)
    {
        $conexao = new conexaoDB();
        $conecta = $conexao->conectar();

        $stmt = $conecta->prepare("INSERT INTO tb_usuario (`user_first_name`, `user_last_name`,`user_name`,`user_email`, `user_password`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$fist_name, $last_name, $username, $email, $hashedPassword);

        $mail = new PHPMailer(true);
        try {
            if ($stmt->execute())  {
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = '0c58445a22fa36';                     //SMTP usernsame
                $mail->Password = '24d6d9aaf85bab';                               //SMTP password
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
                $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
                $mail->Port = 587;
                $mail->Timeout = 5;

                $mail->setFrom('techqa.pida@gmail.com', 'TechQA');
                $mail->addAddress($email, $username);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirmar Cadastro';
                $mail->Body = "Clique no link para poder confirmar o email e ter acesso a conta <a href= 'http://localhost:3000/login.php'>Clique Aqui</a>";
                $mail->AltBody = "Clique no link para poder confirmar o email e ter acesso a conta http://localhost:3000/login.php";

                $mail->send();
                echo "Confirme a sua conta pelo email para poder acessa-la";
                //header("Location: cadastro.php");

            } else {
                echo "Erro no cadastro: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $stmt->close();
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

    public function teste($id_usuario)
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