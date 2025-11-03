<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php'; 
$subSecaoDAO = new SubSecaoDAO();

// Recebe o JSON do front-end
$data = json_decode(file_get_contents('php://input'), true);

// O front envia um array direto, ex: [ {id: 1, ordem: 1}, {id: 2, ordem: 2} ]
if (is_array($data)) {
    if ($subSecaoDAO->atualizarOrdem($data)) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao atualizar no banco']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
}
