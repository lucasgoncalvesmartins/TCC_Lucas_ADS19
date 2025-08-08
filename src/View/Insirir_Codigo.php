<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Inserir Código de Recuperação</title>
</head>
<body>
  <h1>Inserir Código de Recuperação</h1>

  <?php
    $email = $_GET['email'] ?? '';
    if (!$email) {
      echo "<p>E-mail não informado. Volte para solicitar recuperação.</p>";
      exit;
    }
  ?>

  <p>Email: <strong><?= htmlspecialchars($email) ?></strong></p>

  <form id="formVerificarCodigo">
    <label>Código recebido:</label>
    <input type="text" name="codigo" required maxlength="6" pattern="\d{6}" placeholder="000000">
    <button type="submit">Validar Código</button>
  </form>

  <div id="mensagem"></div>

  <script>
  document.getElementById('formVerificarCodigo').addEventListener('submit', function(e) {
    e.preventDefault();

    const codigo = this.codigo.value.trim();
    const email = <?= json_encode($email) ?>;

    if (!/^\d{6}$/.test(codigo)) {
      document.getElementById('mensagem').textContent = 'Código inválido. Deve ter 6 dígitos.';
      return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('codigo', codigo);

    fetch('RecuperaSenhaController.php?function=verificarCodigo', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      document.getElementById('mensagem').textContent = data.message;

      if (data.status === 'success') {
        setTimeout(() => {
          window.location.href = 'redefinir_senha.php?email=' + encodeURIComponent(email) + '&codigo=' + encodeURIComponent(codigo);
        }, 2000);
      }
    });
  });
  </script>
</body>
</html>
