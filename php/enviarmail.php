<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $password = htmlspecialchars(trim($_POST['password']));
    $mail = filter_var(trim($_POST['mail']), FILTER_VALIDATE_EMAIL);
    $nacimiento = htmlspecialchars(trim($_POST['nacimiento']));
    $color_preferido = htmlspecialchars(trim($_POST['color_preferido']));
    $flowers = htmlspecialchars(trim($_POST['flowers']));

    // Validate required fields
    if (!$nombre || !$password || !$mail) {
        echo "<script>alert('Por favor, rellene todos los campos obligatorios correctamente.');</script>";
        exit;
    }

    // Email configuration
    $to = "example@domain.com"; // Replace with your email address
    $subject = "Nuevo mensaje desde el formulario de contacto";
    $headers = "From: " . $mail . "\r\n";
    $headers .= "Reply-To: " . $mail . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email message body
    $message = "<html><body>";
    $message .= "<h2>Detalles del mensaje:</h2>";
    $message .= "<p><strong>Nombre:</strong> " . $nombre . "</p>";
    $message .= "<p><strong>Contraseña:</strong> [Oculta por seguridad]</p>";
    $message .= "<p><strong>Correo electrónico:</strong> " . $mail . "</p>";
    $message .= "<p><strong>Fecha de nacimiento:</strong> " . $nacimiento . "</p>";
    $message .= "<p><strong>Color preferido para las flores:</strong> " . $color_preferido . "</p>";
    $message .= "<p><strong>Flores que tienes actualmente:</strong> " . $flowers . "</p>";
    $message .= "</body></html>";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Gracias, su mensaje ha sido enviado exitosamente.');</script>";
    } else {
        echo "<script>alert('Lo sentimos, ocurrió un error al enviar su mensaje. Inténtelo nuevamente.');</script>";
    }
}
?>