<?php
require_once __DIR__ . '/../Controller/ValidadorCPF.php';

$msgCpf = ""; // mensagem específica do CPF
$msgGeral = ""; // mensagem geral de sucesso ou erro no envio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'] ?? '';
    $cpf   = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';

    // Valida CPF
    if (!ValidadorCPF::validar($cpf)) {
        $msgCpf = " CPF inválido!";
    } else {
        // Só processa PDF se CPF for válido
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
            $nomeArquivo = basename($_FILES['pdf']['name']);
            $destino = __DIR__ . '/../Uploads/' . $nomeArquivo;

            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $destino)) {
                $msgGeral = "✅ Sugestão recebida com sucesso!";
            } else {
                $msgGeral = "❌ Erro ao enviar o PDF.";
            }
        } else {
            $msgGeral = "❌ Nenhum arquivo enviado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/usuarioSugestao.css">
    <title>Enviar PDF</title>
    
</head>
<body>
    <?php include_once __DIR__ . '/header.php'; ?>

    <?php if (!empty($msgGeral)): ?>
        <p class="<?= strpos($msgGeral, 'sucesso') !== false ? 'sucesso' : 'erro' ?>">
            <?= htmlspecialchars($msgGeral) ?>
        </p>
    <?php endif; ?>

    <form id="formSugestao" action="" method="POST" enctype="multipart/form-data">
        <h1>Enviar Sugestão</h1>

        <div>
            <label for="nome">Nome completo:</label><br>
            <input type="text" name="nome" id="nome" required>
        </div>
        <br>

        <div>
            <label for="cpf">CPF:</label><br>
            <input type="text" name="cpf" id="cpf" required>
            <div id="msgCpf" class="erro"><?= $msgCpf ?></div>
        </div>
        <br>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <br>

        <div>
            <label for="pdf">Selecione o PDF:</label><br>
            <input type="file" name="pdf" id="pdf" accept=".pdf" required>
        </div>
        <br>

        <button type="submit">Enviar PDF</button> <br>
        <a href="Home.php" tabindex="0">Voltar</a>
    </form>

    <script>
        
        const form = document.getElementById('formSugestao');
        const cpfInput = document.getElementById('cpf');
        const msgCpfDiv = document.getElementById('msgCpf');

        form.addEventListener('submit', function(e) {
            let cpf = cpfInput.value.replace(/\D/g,''); // remove tudo que não é número

            if(cpf.length !== 11) {
                e.preventDefault(); // bloqueia envio
                msgCpfDiv.textContent = "CPF inválido!";
            } else {
                msgCpfDiv.textContent = ""; // limpa mensagem se válido
            }
        });
    </script>
</body>
</html>
