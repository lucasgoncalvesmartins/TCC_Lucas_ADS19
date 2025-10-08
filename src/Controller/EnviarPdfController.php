<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

$msg = '';
$emailAdmin = 'lcxmartins2019@gmail.com'; 
$senhaApp   = 'uiox oilt nhgy mpxi';      

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome  = $_POST['nome'] ?? '';
    $profissao   = $_POST['profissao'] ?? '';
    $email = $_POST['email'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

  
    if (!$nome || !$profissao || !$email || !$descricao) {
        $msg = 'Preencha todos os campos.';
    } elseif (!isset($_FILES['pdf'])) {
        $msg = 'Nenhum arquivo PDF enviado.';
    } else {
        $arquivo = $_FILES['pdf'];

        if ($arquivo['error'] === 0 && pathinfo($arquivo['name'], PATHINFO_EXTENSION) === 'pdf') {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $emailAdmin;
                $mail->Password = $senhaApp;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($emailAdmin, 'Sistema');
                $mail->addAddress($emailAdmin); 

                $mail->isHTML(true);
                $mail->Subject = 'PDF enviado pelo sistema';
                $mail->Body = "
                    <p>Um novo PDF foi enviado pelo usuário:</p>
                    <ul>
                        <li><strong>Nome completo:</strong> {$nome}</li>
                        <li><strong>profissao:</strong> {$profissao}</li>
                        <li><strong>Email:</strong> {$email}</li>
                        <li><strong>Descrição:</strong> {$descricao}</li>
                    </ul>
                    <p>O PDF está em anexo.</p>
                ";

                $mail->addAttachment($arquivo['tmp_name'], $arquivo['name']);

                $mail->send();
                $msg = 'PDF enviado com sucesso!';
            } catch (Exception $e) {
                $msg = 'Erro ao enviar email: ' . $mail->ErrorInfo;
            }
        } else {
            $msg = 'Selecione um arquivo PDF válido.';
        }
    }
}
