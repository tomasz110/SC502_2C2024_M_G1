
<?php
require '../vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pruebastomas11@gmail.com';  
    $mail->Password   = 'ikru zude njfi irnh';    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($_POST['email'], 'Equipo Ecosales');
    $mail->addAddress($_POST['email']);  
    $mail->Subject = 'Nos contactaste!';
    $mail->Body = "Hola " . htmlspecialchars($_POST['email']) . ",\n\n" .
    "Gracias por ponerte en contacto con nosotros. Hemos recibido tu mensaje y nuestro equipo está revisándolo. Nos esforzamos por responder a todas las consultas en un plazo de 24 horas.\n\n" .
    "Asunto:\n" . htmlspecialchars($_POST['asunto']) . "\n\n" .
    "Si tu consulta es urgente, por favor, no dudes en llamarnos al 11111 para recibir una respuesta más rápida.\n\n" .
    "Gracias por tu paciencia y comprensión.\n\n" .
    "Saludos cordiales,\n\n" .
    "Equipo EcoSales\n";


    $mail->send();
    echo 'success'; 
} catch (Exception $e) {
    error_log('Error al enviar el correo: ' . $e->getMessage()); 
    echo 'error'; 
}
?>


