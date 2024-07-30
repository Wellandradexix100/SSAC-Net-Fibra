<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Se você usou o Composer
require 'vendor/autoload.php';

// Se você baixou manualmente
// require 'libs/phpmailer/src/Exception.php';
// require 'libs/phpmailer/src/PHPMailer.php';
// require 'libs/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'Ybdf69f33d23b8d'; // Substitua pelo seu nome de usuário do Mailtrap
        $mail->Password = 'Y7163b7a3bc4183'; // Substitua pela sua senha do Mailtrap
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // Ou 2525

        // Configurações do e-mail
        $mail->setFrom($email, $name);
        $mail->addAddress('5631e03cca-b50895+1@inbox.mailtrap.io'); // Substitua pelo seu e-mail
        $mail->isHTML(false); // Se preferir texto simples
        $mail->Subject = 'Nova mensagem do formulário de contato';
        $mail->Body    = "Nome: $name\n" .
                          "Telefone: $phone\n" .
                          "Email: $email\n" .
                          "Mensagem:\n$message";

        // Enviar o e-mail
        $mail->send();
        echo 'E-mail enviado com sucesso.';
    } catch (Exception $e) {
        echo 'Não foi possível enviar o e-mail. Erro: ', $mail->ErrorInfo;
    }
} else {
    echo 'Método de solicitação inválido.';
}
?>
