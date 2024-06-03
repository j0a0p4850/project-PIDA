<?php

session_start();
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram preenchidos
    if (isset($_SESSION['login'])) {
        // Obtém os dados do formulário
        $user_id = $_SESSION['login'];
        $user_description = $_POST['user_description'];
        $habilidades = $_POST['habilidades'] ?? '';
        $habilidade_descricao = $_POST['habilidade_descricao'] ?? '';
        $empresa = $_POST['empresa'] ?? '';
        $cargo = $_POST['cargo'] ?? '';

        // Inclua a classe do banco de dados e a função atualizarInformacoesUsuario
        // Substitua 'conexaoDB.php' pelo nome do seu arquivo de conexão
        require_once 'funcoes_usuario.php'; // Substitua 'sua_classe.php' pelo nome do arquivo onde está a sua classe

        // Instancia a sua classe
        $obj = new funcoes(); // Substitua 'SuaClasse' pelo nome da sua classe

        // Chama a função para atualizar as informações do usuário
        $obj->atualizarInformacoesUsuario($user_id, $user_description, $habilidades, $habilidade_descricao, $empresa, $cargo);
    } else {
        // Mensagem de erro se os campos obrigatórios não foram preenchidos
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    // Redirecionamento se o formulário não foi enviado
    header("Location: perfil_usuario.php");
    exit;
}
?>
