<?php
session_start();
include "funcoes_result.php";

header('Content-Type: application/json');

if (isset($_SESSION['login']) && isset($_POST['id'])) {
    $id_user = $_SESSION['login'];
    $id_post = $_POST['id'];
    $func = new resultados();

    try {
        $result = $func->incrementValue($id_post, $id_user);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to increment value']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid session or missing parameters']);
}
?>
