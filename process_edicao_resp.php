<?php

session_start();
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID da postagem foi passado pela URL
    if (isset($_GET['resp_edicao_id'])) {
        // Obtém os dados do formulário
        $resp_id = $_GET['resp_edicao_id'];
        $resp_body = trim($_POST['resp_body'] ?? '');

        // Inclua a classe do banco de dados e a função atualizarInformacoesUsuario
        require_once 'funcoes_result.php'; // Substitua 'funcoes_result.php' pelo nome do seu arquivo de funções

        // Instancia a sua classe
        $obj = new resultados(); // Substitua 'resultados' pelo nome da sua classe

        // Chama a função para atualizar as informações do usuário
        $obj->editar_resp($resp_id, $resp_body);
    } else {
        // Mensagem de erro se o ID da postagem não foi passado
        echo "<script>alert('Por favor, forneça o ID da postagem.')</script>";
    }
} else {
    // Redirecionamento se o formulário não foi enviado
    header('Location: pagina_de_resultados.php');
    exit;
}
?>