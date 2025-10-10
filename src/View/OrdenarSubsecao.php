<?php
include_once __DIR__ . '/../Controller/SubSecaoController.php';

$subSecaoDAO = new SubSecaoDAO();

$id_secao = $_GET['secao'] ?? null;
if (!$id_secao) {
    echo "Seção não informada!";
    exit;
}

$subsecoes = $subSecaoDAO->buscarPorSecao((int)$id_secao);


usort($subsecoes, function($a, $b) {
    return $a['ordem'] <=> $b['ordem'];
});
?>
<!DOCTYPE html>
<html>
<head>
<title>Ordenar SubSeções</title>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
    #listaSub { list-style: none; padding: 0; width: 400px; }
    #listaSub li { padding: 10px; margin: 5px 0; background: #f0f0f0; cursor: move; border: 1px solid #ccc; }
</style>
</head>
<body>
<h2>Arraste as subseções para reordenar</h2>
<ul id="listaSub">
<?php foreach($subsecoes as $sub): ?>
    <li data-id="<?= $sub['id'] ?>">
        <?= htmlspecialchars($sub['titulo']) ?>
    </li>
<?php endforeach; ?>
</ul>
<button id="salvar">Salvar Ordem</button>

<script>
const lista = document.getElementById('listaSub');

const sortable = new Sortable(lista, {
    animation: 150
});

document.getElementById('salvar').addEventListener('click', () => {
    const ordem = Array.from(lista.children).map((li, index) => ({
        id: li.dataset.id,
        ordem: index + 1
    }));

    fetch('salvarOrdemSubSecao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(ordem)
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'sucesso') {
            alert('Ordem salva com sucesso!');
        } else {
            alert('Erro ao salvar ordem!');
        }
    });
});
</script>
</body>
</html>
