<?php
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['nome'] ?? '';
$sugestao = $_POST['sugestao'] ?? '';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'lcxmartins2019@gmail.com';
$mail->Password = 'cjpi npqk ocbh evdu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->CharSet = 'UTF-8';
$mail->SMTPDebug = 0;

$mail->setFrom('eventqiffar@gmail.com', 'Formulário de Sugestão');
$mail->addAddress('lucascamargogoncalvesmartins@gmail.com');

$mail->isHTML(true);
$mail->Subject = 'Nova Sugestão de Melhoria';
$body  = '<h2>Nova sugestão recebida</h2>';
$body .= '<p><strong>Nome:</strong> ' . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . '</p>';
$body .= '<p><strong>Sugestão:</strong><br>' . nl2br(htmlspecialchars($sugestao, ENT_QUOTES, 'UTF-8')) . '</p>';
$mail->Body = $body;
$mail->AltBody = "Nova sugestão recebida\n\nNome: " . $nome . "\nSugestão:\n" . $sugestao;

if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    $mail->AddAttachment($_FILES['pdf']['tmp_name'], $_FILES['pdf']['name']);
}
$mail->send();

?>
