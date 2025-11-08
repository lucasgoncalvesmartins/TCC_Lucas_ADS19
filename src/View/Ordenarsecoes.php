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

<!-- Região lida pelo leitor de tela -->
<div id="avisos"
     aria-live="assertive"
     aria-atomic="true"
     style="position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden;">
</div>

<?php include 'header.php'; ?>

<main>
<h1>Arraste as seções ou use as setas para reordenar as seções</h1>

<ul id="listaSessoes" role="listbox">
    <?php foreach ($secoes as $secao): ?>
        <li tabindex="0"
            role="option"
            aria-grabbed="false"
            data-id="<?= $secao['id'] ?>">
            
            <span class="numero"><?= $secao['ordem'] ?></span>
            <span class="titulo"><?= htmlspecialchars($secao['nome']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<button id="salvar">Salvar Ordem</button><br><br>
<a href="Home.php" class="btn btn-link" tabindex="0">Voltar para página inicial</a>

<script>
const lista = document.getElementById('listaSessoes');
const avisos = document.getElementById('avisos');

// arrastar com o mouse
const sortable = new Sortable(lista, {
    animation: 150,
    onEnd: function(evt) {
        atualizarNumeros();

        const item = evt.item;
        const titulo = item.querySelector('.titulo').innerText.trim();
        const novaPos = evt.newIndex + 1;

        anunciar(titulo + " movida para a posição " + novaPos);
    }
});

// atualiza numeração 
function atualizarNumeros() {
    Array.from(lista.children).forEach((li, index) => {
        li.querySelector('.numero').textContent = index + 1;
    });
}

//  leitura pelo leitor de tela
function anunciar(msg) {
    avisos.textContent = "";  
    setTimeout(() => {
        avisos.textContent = msg;
    }, 30);
}

// ordem por setas
lista.addEventListener('keydown', e => {
    const foco = document.activeElement;
    if (!foco || !foco.matches('li[data-id]')) return;

    const titulo = foco.querySelector('.titulo').innerText.trim();

    if (e.key === 'ArrowUp') {
        const anterior = foco.previousElementSibling;
        if (anterior) {
            lista.insertBefore(foco, anterior);
            foco.focus();

            foco.setAttribute('aria-grabbed', 'true');
            anunciar(titulo + " movida para cima");
            foco.setAttribute('aria-grabbed', 'false');

            atualizarNumeros();
        }
        e.preventDefault();
    }

    if (e.key === 'ArrowDown') {
        const proximo = foco.nextElementSibling;
        if (proximo) {
            lista.insertBefore(proximo, foco);
            foco.focus();

            foco.setAttribute('aria-grabbed', 'true');
            anunciar(titulo + " movida para baixo");
            foco.setAttribute('aria-grabbed', 'false');

            atualizarNumeros();
        }
        e.preventDefault();
    }
});

// salva ordem
// salvar nova ordem
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
        

            // limpa para garantir leitura
            avisos.textContent = "";

            // força o leitor a ler a mensagem completa
            setTimeout(() => {
                avisos.textContent = "Ordem das seções salva com sucesso";
            }, 30);

            // dá tempo do leitor terminar a fala antes de redirecionar
            setTimeout(() => {
                window.location.href = "Home.php";
            }, 900);

        
    });
});

</script>

</main>
</body>
</html>
