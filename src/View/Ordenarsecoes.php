<?php
include_once __DIR__ . '/../Controller/SecaoDAO.php';

$secaoDAO = new SecaoDAO();
$secoes = $secaoDAO->listarTodas();

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
<link rel="stylesheet" href="../Css/ordenarsecao.css">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

</head>
<body>
<?php include 'header.php'; ?>
<main>
<h1>Arraste as seções ou use as setas para reordenar as seções</h1>

<ul id="listaSessoes">
    <?php foreach ($secoes as $secao): ?>
        <li tabindex="0" data-id="<?= $secao['id'] ?>">
            <span class="numero"><?= $secao['ordem'] ?></span>
            <span class="titulo"><?= htmlspecialchars($secao['nome']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<button id="salvar">Salvar Ordem</button><br><br>
<a href="home.php" class="btn btn-link" tabindex="0">Voltar</a>

<script>
const lista = document.getElementById('listaSessoes');

//  arrastar
const sortable = new Sortable(lista, {
    animation: 150,
    onEnd: atualizarNumeros
});

// Atualiza numeração 
function atualizarNumeros() {
    Array.from(lista.children).forEach((li, index) => {
        li.querySelector('.numero').textContent = index + 1;
    });
}

//  teclado setas
lista.addEventListener('keydown', e => {
    const foco = document.activeElement;
    if (!foco || !foco.matches('li[data-id]')) return;

    if (e.key === 'ArrowUp') {
        const anterior = foco.previousElementSibling;
        if (anterior) {
            lista.insertBefore(foco, anterior);
            foco.focus();
            atualizarNumeros();
        }
        e.preventDefault();
    }

    if (e.key === 'ArrowDown') {
        const proximo = foco.nextElementSibling;
        if (proximo) {
            lista.insertBefore(proximo, foco);
            foco.focus();
            atualizarNumeros();
        }
        e.preventDefault();
    }
});

// Salvar nova ordem 
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
            window.location.href = 'home.php';
        } else {
            alert('seção salva com sucesso.');
        }
    });
});
</script>
</main>
</body>
</html>
