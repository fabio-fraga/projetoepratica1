<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'forumf4all@gmail.com';
    $mail->Password = 'forumf4all';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('forumf4all@gmail.com', 'Fórum For All - F4All');
    $mail->addAddress($email, $nome);

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Código de confirmação - F4All!';
    $mail->Body    = 'Olá, ' . $nome . '! Aqui está o seu código de confirmação para finalizar o cadastro no F4All! =)' . '<br>' . 'Código: ' . RANDOM;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
