<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php'; 
$subSecaoDAO = new SubSecaoDAO();

// Recebe o JSON do front-end
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data) && isset($data['ordem'])) {
    $ordemArray = $data['ordem']; // array de {id, ordem}

    if ($subSecaoDAO->atualizarOrdem($ordemArray)) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao atualizar no banco']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
}
