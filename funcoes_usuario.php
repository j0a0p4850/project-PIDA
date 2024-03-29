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
                echo '<h3>'. $linha['user_name'].'</h3>';
            }

        }
        else{
            echo 'Usuario não possui username';
        }
            $conexao->desconectar();
        }
    }


?>