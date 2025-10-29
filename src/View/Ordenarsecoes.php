<?php
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas(); // Lista todas as seções

// Ordena pelo campo "ordem"
usort($secoes, function($a, $b) {
    return $a['ordem'] <=> $b['ordem'];
});

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Reordenar Seções</title>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
    #listaSessoes { list-style: none; padding: 0; width: 400px; }
    #listaSessoes li { 
        padding: 10px; 
        margin: 5px 0; 
        background: #f0f0f0; 
        cursor: move; 
        border: 1px solid #ccc; 
        display: flex; 
        align-items: center;
    }
    #listaSessoes li span.numero {
        width: 30px;
        font-weight: bold;
    }
</style>
</head>
<body>
<?php include 'header.php'; ?>
<h2>Arraste as seções para reordenar</h2>

<ul id="listaSessoes">
    <?php foreach ($secoes as $secao): ?>
        <li data-id="<?= $secao['id'] ?>">
            <span class="numero"><?= $secao['ordem'] ?></span>
            <span class="titulo"><?= htmlspecialchars($secao['nome']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<button id="salvar">Salvar Ordem</button>

<script>
const lista = document.getElementById('listaSessoes');

const sortable = new Sortable(lista, {
    animation: 150,
    onEnd: () => {
        
        Array.from(lista.children).forEach((li, index) => {
            li.querySelector('.numero').textContent = index + 1;
        });
    }
});

document.getElementById('salvar').addEventListener('click', () => {
    const ordem = Array.from(lista.children).map((li, index) => ({
        id: li.dataset.id,
        ordem: index + 1
    }));

    fetch('salvar_ordem.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(ordem)
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'sucesso') {
           // alert('Ordem salva com sucesso!');
            window.location.href = 'home.php';
        } else {
           // alert('Ordem salva com sucesso!');
            window.location.href = 'home.php';
        }
    });
});
</script>
    <a href="Home.php" class="btn btn-link" tabindex="0">Voltar</a>
</body>
</html>
