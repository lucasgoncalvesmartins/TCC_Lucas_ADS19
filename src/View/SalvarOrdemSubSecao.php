<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php'; 
$subSecaoDAO = new SubSecaoDAO();

/// Recebe os dados JSON
$data = json_decode(file_get_contents('php://input'), true);


if (is_array($data)) {
    if ($subSecaoDAO->atualizarOrdem($data)) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao atualizar no banco']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
}
