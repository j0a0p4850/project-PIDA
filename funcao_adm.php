<?php

include 'conexao_db.php';

class administrador_func {
    
    private $conecta;
    
    public function __construct($conecta) {
        $this->conecta = $conecta;
    }

    public function denuncia_registro($reasons, $otherReason, $id_user, $reportType, $id_pergunta, $id_comentario, $id_resposta) {
        // Se o id_user não for fornecido, buscar a partir do id_pergunta
        if ($id_user == null && $id_pergunta != null) {
            $sql = "SELECT user_id FROM tb_pergunta WHERE id_pergunta = ?";
            $stmt = $this->conecta->prepare($sql);
            $stmt->bind_param("i", $id_pergunta);
            $stmt->execute();
            $stmt->bind_result($id_user);
            $stmt->fetch();
            $stmt->close();
        }

        // Preparar e executar a inserção na tabela de denúncias
        $query = "INSERT INTO tb_denuncias (id_user, id_pergunta, id_comentario, id_resposta, motivo, outro) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conecta->prepare($query);

        // Combinar motivos e outros motivos
        $motivos = implode(', ', $reasons);
        if (!empty($otherReason)) {
            $motivos .= ($motivos ? ', ' : '') . $otherReason;
        }

        // Definir valores baseados no tipo de relatório
        $id_pergunta = ($reportType === 'pergunta') ? $id_pergunta : null;
        $id_comentario = ($reportType === 'comentario') ? $id_comentario : null;
        $id_resposta = ($reportType === 'resposta') ? $id_resposta : null;

        // Vincular parâmetros e executar
        $stmt->bind_param("iiiiss", $id_user, $id_pergunta, $id_comentario, $id_resposta, $motivos, $otherReason);
        $stmt->execute();
        $stmt->close();
    }
}
?>
