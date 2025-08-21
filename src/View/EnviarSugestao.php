<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="../Controller/enviaEmail.php" method="post">
<label for="nome">Seu Nome:</label>
    <input type="text" id="nome"><br><br>
    <label for="sugestao">Sua Sugestão de melhoria:</label>
    <input type="text" id="sugestao"><br><br>
    <label for="pdf">"Artigo de Melhoria:"</label>
    <input type="file" id="pdf"><br><br>
    <input type="submit">
</form>
</body>
</html>