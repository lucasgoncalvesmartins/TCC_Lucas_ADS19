<?php
namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

class FaleConoscoController {

    private $emailAdmin = 'lcxmartins2019@gmail.com';
    private $senhaApp   = 'uiox oilt nhgy mpxi';

    public $msg = '';

    public function enviarMensagem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome       = trim($_POST['nome'] ?? '');
            $profissao  = trim($_POST['profissao'] ?? '');
            $email      = trim($_POST['email'] ?? '');
            $sugestoes  = trim($_POST['sugestoes'] ?? '');
            $arquivo    = $_FILES['pdf'] ?? null;

            if (!$nome || !$profissao || !$email) {
                $this->msg = 'Preencha todos os campos obrigatórios.';
                return;
            }

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $this->emailAdmin;
                $mail->Password = $this->senhaApp;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($this->emailAdmin, 'Sistema');
                $mail->addAddress($this->emailAdmin);

                $mail->isHTML(true);
                $mail->Subject = "Fale Conosco - Nova mensagem de $nome";
                $mail->Body = "
                    <p>Você recebeu uma nova mensagem pelo Fale Conosco:</p>
                    <ul>
                        <li><strong>Nome:</strong> {$nome}</li>
                        <li><strong>Profissão:</strong> {$profissao}</li>
                        <li><strong>Email:</strong> {$email}</li>
                    </ul>
                    <p><strong>Sugestões:</strong></p>
                    <p>{$sugestoes}</p>
                ";

                // Anexa PDF se enviado
                if ($arquivo && $arquivo['error'] === 0 && pathinfo($arquivo['name'], PATHINFO_EXTENSION) === 'pdf') {
                    $mail->addAttachment($arquivo['tmp_name'], $arquivo['name']);
                }

                $mail->send();
                $this->msg = 'Mensagem enviada com sucesso!';
            } catch (Exception $e) {
                $this->msg = 'Erro ao enviar email: ' . $mail->ErrorInfo;
            }
        }
    }
}
