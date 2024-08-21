
<?php
require '../vendor/autoload.php'; // Ajusta esta ruta según la estructura de tu proyecto

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Servidor SMTP de Gmail
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pruebastomas11@gmail.com';  // Tu dirección de Gmail
    $mail->Password   = 'ikru zude njfi irnh';    // Tu contraseña de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Configuración del correo
    $mail->setFrom($_POST['email'], 'Equipo Ecosales');
    $mail->addAddress($_POST['email']);  // Correo receptor
    $mail->Subject = 'Nos contactaste!';
    $mail->Body = "Hola " . htmlspecialchars($_POST['email']) . ",\n\n" .
    "Gracias por ponerte en contacto con nosotros. Hemos recibido tu mensaje y nuestro equipo está revisándolo. Nos esforzamos por responder a todas las consultas en un plazo de 24 horas.\n\n" .
    "Asunto:\n" . htmlspecialchars($_POST['asunto']) . "\n\n" .
    "Si tu consulta es urgente, por favor, no dudes en llamarnos al 11111 para recibir una respuesta más rápida.\n\n" .
    "Gracias por tu paciencia y comprensión.\n\n" .
    "Saludos cordiales,\n\n" .
    "Equipo EcoSales\n";


    $mail->send();
    echo 'success'; // Enviar un mensaje de éxito a AJAX
} catch (Exception $e) {
    error_log('Error al enviar el correo: ' . $e->getMessage()); // Registrar el error en el log del servidor
    echo 'error'; // Enviar un mensaje de error a AJAX
}
?>


