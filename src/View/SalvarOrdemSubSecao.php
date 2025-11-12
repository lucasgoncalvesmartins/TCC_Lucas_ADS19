<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php'; 
$subSecaoDAO = new SubSecaoDAO();


$data = json_decode(file_get_contents('php://input'), true);

//  array direto com id e ordem
if (is_array($data)) {
    if ($subSecaoDAO->atualizarOrdem($data)) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao atualizar no banco']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
}
