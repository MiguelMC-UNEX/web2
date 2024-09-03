<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Verifica que los datos no estén vacíos
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor complete el formulario correctamente.";
        exit;
    }

    // Dirección de correo donde se enviará el mensaje
    $recipient = "microsoft123323@gmail.com";

    // Asunto del correo
    $subject = "Nuevo mensaje de contacto de $name";

    // Contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content = "Correo: $email\n\n";
    $email_content = "Mensaje:\n$message\n";

    // Encabezados del correo
    $email_headers = "From: $name <$email>";

    // Intenta enviar el correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Gracias! Tu mensaje ha sido enviado.";
    } else {
        http_response_code(500);
        echo "Oops! Algo salió mal y no pudimos enviar tu mensaje.";
    }

} else {
    http_response_code(403);
    echo "Hubo un problema con el envío, inténtelo de nuevo.";
}
?>
