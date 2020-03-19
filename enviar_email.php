<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'everthon.henrique.74@gmail.com';                     
    $mail->Password   = '85265816123';                          
    $mail->Port= 587;
    $mail->SMTPSecure = 'tls';                                    

    $mail->setFrom('everthon.henrique.75@gmail.com', 'Everthon');
    $mail->addAddress('fabinhoookara100@gmail.com', 'Fabio');     
    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'a mina do 1 periodo';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>