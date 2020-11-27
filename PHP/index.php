<?php
/**
* SCRIPT PARA ENVIAR CORREO A TRAVÉS DE PHPMEAILER
**/

// Importar clases de PHPMailer al espacio de trabajo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer();

//Le decimos a PHPMailer que use SMTP
$mail->isSMTP();

// Habilita la depuración SMTP
// SMTP::DEBUG_OFF = off (para uso en producción)
// SMTP::DEBUG_CLIENT = mensajes de cliente
// SMTP::DEBUG_SERVER = mensajes de cliente y servidor
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Establecer el nombre de host del servidor de correo
$mail->Host = 'smtp.gmail.com';
// usar
// $mail->Host = gethostbyname('smtp.gmail.com');
// si su red no es compatible con SMTP sobre IPv6

// Establezca el número de puerto SMTP: 587 para TLS autenticado, también conocido como envío SMTP RFC4409
$mail->Port = 587;

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// Si usar la autenticación SMTP
$mail->SMTPAuth = true;

//Nombre de usuario que se utilizará para la autenticación SMTP: utilice la dirección de correo electrónico completa para gmail
$mail->Username = 'SUCORREO@gmail.com';

//Contraseña que se utilizará para la autenticación SMTP
$mail->Password = 'SUCONTRASEÑA';

//Establecer desde quién se enviará el mensaje
$mail->setFrom('SUCORREO@gmail.com', 'SU NOMBRE');

//Establecer una dirección de respuesta alternativa
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Establecer a quién se enviará el mensaje
$mail->addAddress('CORREODEDESTINO@gmail.com', 'NOMBRE DE DESTINO');

//Set the subject line
$mail->Subject = 'PHPMailer Gmail SMTP test';

// Leer el cuerpo de un mensaje HTML de un archivo externo, convertir imágenes referenciadas en incrustadas,
// convierte HTML en un cuerpo alternativo básico de texto plano
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->Body = 'Este es el cuerpo de un mensaje de texto sin formato';
//Replace the plain text body with one created manually
$mail->AltBody = 'Este es el cuerpo de un mensaje de texto sin formato';

// Adjuntar un archivo de imagen
//$mail->addAttachment('images/phpmailer_mini.png');

// Activar condificacción utf-8
$mail->CharSet = 'UTF-8';
// envía el mensaje, busca errores
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Sección 2: IMAP
    //Descomente estos para guardar su mensaje en la carpeta 'Send Folder'.
    #if (save_mail($mail)) {
    #    echo "Mensaje guardado!";
    #}
}

//Sección 2: IMAP
// Los comandos IMAP requieren la extensión PHP IMAP, que se encuentra en: https://php.net/manual/en/imap.setup.php
// Función para llamar que usa las funciones PHP imap _ * () para guardar mensajes: https://php.net/manual/en/book.imap.php
// Puede usar imap_getmailboxes ($ imapStream, '/ imap / ssl', '*') para obtener una lista de carpetas o etiquetas disponibles, esto puede ser útil si está intentando que esto funcione en un servidor IMAP que no sea de Gmail.
function save_mail($mail)
{
    // Puede cambiar 'Send Mail' a cualquier otra carpeta o etiqueta
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    // Dile a tu servidor que abra una conexión IMAP usando el mismo nombre de usuario y contraseña que usaste para SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}