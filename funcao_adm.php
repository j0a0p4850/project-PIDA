<?php

include 'conexao_db.php';

class administrador_func {
    
    private $conecta;
    
    public function __construct($conecta) {
        $this->conecta = $conecta;
    }

    public function denuncia_registro($reasons, $otherReason, $id_user, $id_coringa, $id_user_q_denunciou, $tipo) {
        
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
        } 
        elseif ($id_user == null && $tipo == 'resposta') {
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
            header("Location: pagina_de_resultados.php");
            exit(); // Certifique-se de sair após o redirecionamento
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
