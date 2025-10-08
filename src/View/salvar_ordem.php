<?php
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$dados = json_decode(file_get_contents('php://input'), true);

$secaoDAO = new SecaoDAO();
$sucesso = true;

foreach ($dados as $item) {
    
    $secaoAtual = $secaoDAO->buscarPorId($item['id']);

    if ($secaoAtual) {
        $res = $secaoDAO->editarOrdem([
            'id' => $item['id'],
            'ordem' => $item['ordem'],
            'nome' => $secaoAtual['nome'],       
            'descricao' => $secaoAtual['descricao'] 
        ]);

        if (!$res) $sucesso = false;
    } else {
        $sucesso = false;
    }
}

header('Content-Type: application/json');
echo json_encode(['status' => $sucesso ? 'sucesso' : 'erro']);
