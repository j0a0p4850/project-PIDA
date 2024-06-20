<?php

include 'conexao_db.php';

class administrador_func
{

    private $conecta;



    public function __construct($conecta)
    {
        $this->conecta = $conecta;
    }

    public function denuncia_registro($reasons, $otherReason, $id_user, $id_coringa, $id_user_q_denunciou, $tipo)
    {

        // Inicialize as variáveis para evitar erros de uso de variáveis não atribuídas
        $pergunta_user_id = null;
        $comentario_user_id = null;
        $id_pergunta = null;
        $id_comentario = null;
        $id_resposta = null;

        // Verifica o tipo de denúncia e busca os dados necessários
        if ($id_user == null && $tipo == 'pergunta') {
            $sql = "SELECT user_id FROM tb_pergunta WHERE id_pergunta = ?";
            $stmt = $this->conecta->prepare($sql);
            $stmt->bind_param("i", $id_coringa);
            $stmt->execute();
            $stmt->bind_result($id_user);
            $stmt->fetch();
            $stmt->close();

            $id_pergunta = $id_coringa; // A denúncia é para a própria pergunta
        } elseif ($id_user == null && $tipo == 'comentario') {
            $sql = "SELECT p.user_id AS pergunta_user_id, 
                           c.id_user AS comentario_user_id, 
                           p.id_pergunta
                    FROM tb_comentarios c
                    INNER JOIN tb_pergunta p ON c.id_pergunta = p.id_pergunta 
                    WHERE c.id_comentario = ?";
            $stmt = $this->conecta->prepare($sql);
            $stmt->bind_param("i", $id_coringa);
            $stmt->execute();
            $stmt->bind_result($pergunta_user_id, $comentario_user_id, $id_pergunta);
            $stmt->fetch();
            $stmt->close();

            $id_user = $comentario_user_id;
            $id_comentario = $id_coringa; // A denúncia é para o comentário
        } elseif ($id_user == null && $tipo == 'resposta') {
            $sql = "SELECT p.user_id AS pergunta_user_id, 
                            c.id_user AS comentario_user_id, 
                            p.id_pergunta,
                            r.id_resposta,
                            r.id_comentario
                            FROM tb_resposta r
                            INNER JOIN tb_comentarios c ON r.id_comentario = c.id_comentario
                            INNER JOIN tb_pergunta p ON c.id_pergunta = p.id_pergunta 
                            WHERE r.id_resposta = ?";
            $stmt = $this->conecta->prepare($sql);
            $stmt->bind_param("i", $id_coringa);
            $stmt->execute();
            $stmt->bind_result($pergunta_user_id, $comentario_user_id, $id_pergunta, $id_resposta, $id_comentario);
            $stmt->fetch();
            $stmt->close();

            $id_user = $comentario_user_id;
            $id_resposta = $id_coringa; // A denúncia é para a resposta
            $id_comentario = $id_comentario; // Captura o id_comentario associado à resposta

            // Chama o método denuncia_registro com os valores corretos

        }



        // Preparar e executar a inserção na tabela de denúncias
        $query = "INSERT INTO tb_denuncias (id_user_denunciado, id_pergunta, id_comentario, id_resposta, id_user_denunciou, motivo, outro) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conecta->prepare($query);

        // Combinar motivos e outros motivos
        $motivos = implode(', ', $reasons);
        if (!empty($otherReason)) {
            $motivos .= ($motivos ? ', ' : '') . $otherReason;
        }

        // Definir valores baseados no tipo de relatório
        $id_pergunta_final = ($tipo === 'pergunta') ? $id_coringa : $id_pergunta;
        $id_comentario_final = ($tipo === 'comentario') ? $id_coringa : $id_comentario;
        $id_resposta_final = ($tipo === 'resposta') ? $id_coringa : $id_resposta;

        // Vincular parâmetros e executar
        $stmt->bind_param("iiiiiss", $id_user, $id_pergunta_final, $id_comentario_final, $id_resposta_final, $id_user_q_denunciou, $motivos, $otherReason);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Denuncia Feita com sucesso, obrigado');
                    setTimeout(function () {
                        window.history.back();
                    }, 300); 
                </script>";
            exit(); // Certifique-se de sair após o redirecionamento
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    public function logar_adm($code, $password) {
        // Verifica se a conexão está definida corretamente
        if (!$this->conecta) {
            die("Erro: Conexão não inicializada corretamente.");
        }

        // Utiliza prepared statements para segurança
        $sql = "SELECT id_administrador FROM tb_adm_user WHERE codigo_acesso = ? AND password_adm = ?";
        $stmt = $this->conecta->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conecta->error);
        }

        // Bind dos parâmetros e execução da query
        $stmt->bind_param("ss", $code, $password);
        $stmt->execute();

        // Obtém o resultado da query
        $resultado = $stmt->get_result();

        // Verifica se encontrou algum registro
        if ($resultado->num_rows > 0) {
            // Obtém os dados do administrador
            $linha = $resultado->fetch_assoc();
            $id_administrador = $linha["id_administrador"];

            // Inicia a sessão
            session_start();
            $_SESSION['id_administrador'] = $id_administrador;

            // Redireciona para a página desejada
            header('Location: perfil_administrador.php');
            exit();
        } else {
            // Credenciais inválidas
            return false;
        }

        // Fecha o statement e a conexão
        $stmt->close();
        $this->conecta->close();
    }
    
    public function obterDetalhesDenuncias($offset, $limit) {
        $sql = "
        SELECT 
            d.id_denuncia,
            u1.user_name AS nome_denunciado,
            u2.user_name AS nome_denunciou,
            CASE 
                WHEN d.id_pergunta IS NOT NULL THEN p.pergunta_descricao
                WHEN d.id_comentario IS NOT NULL THEN c.comentario_corpo
                WHEN d.id_resposta IS NOT NULL THEN r.resposta_descricao
                ELSE 'Descrição não disponível'
            END AS descricao_denunciada,
            d.motivo,
            d.outro,
            d.id_pergunta  
        FROM 
            tb_denuncias d
        INNER JOIN 
            tb_usuario u1 ON d.id_user_denunciado = u1.id_user
        INNER JOIN 
            tb_usuario u2 ON d.id_user_denunciou = u2.id_user
        LEFT JOIN 
            tb_pergunta p ON d.id_pergunta = p.id_pergunta
        LEFT JOIN 
            tb_comentarios c ON d.id_comentario = c.id_comentario
        LEFT JOIN 
            tb_resposta r ON d.id_resposta = r.id_resposta
        LIMIT ? OFFSET ?;
        ";
    
        if ($stmt = $this->conecta->prepare($sql)) {
            $stmt->bind_param("ii", $limit, $offset);
            $stmt->execute();
            $result = $stmt->get_result();
            $denuncias = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $denuncias;
        } else {
            echo "Erro na preparação da consulta: " . $this->conecta->error;
            return false;
        }
    }
        public function obterNumeroTotalDenuncias() {
            $sql = "SELECT COUNT(*) as total FROM tb_denuncias";
            if ($result = $this->conecta->query($sql)) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                echo "Erro na consulta: " . $this->conecta->error;
                return false;
            }
        }
    
    








    public function registra_adm($nome_administrador, $hashedPassword)
    {
        $codigo_acesso = $this->gerarCodigoAcesso();

        $stmt = $this->conecta->prepare("INSERT INTO tb_adm_user (user_name, user_password, codigo_acesso) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_administrador, $hashedPassword, $codigo_acesso);
        $stmt->execute();
        $stmt->close();
    }



    private function gerarCodigoAcesso($tamanho = 10)
    {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $codigo = '';
        for ($i = 0; $i < $tamanho; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $codigo;
    }

    public function criarAdmin($nome_administrador, $password)
    {
        $codigo_acesso = $this->gerarCodigoAcesso();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->registra_adm($nome_administrador, $hashedPassword, $codigo_acesso);
    }
}

?>