<?php
 
// check for form submission - useful if someone is trying to browse directly to this PHP file.
//If check is negative it will redirect back to your contact page.
if (!isset($_POST['save']) || $_POST['save'] != 'contacto climbo') {
header('Location: contacto.html'); exit;
}
// get the posted data
$name = $_POST['contact_name'];
$email_address = $_POST['contact_email'];
$message = $_POST['contact_message'];
// check that a name was entered
if (empty($name))
$error = 'Debes introducir tu nombre.';
// check that an email address was entered
elseif (empty($email_address))
$error = 'Debes introducir tu dirección de correo electrónico.';
// check for a valid email address
elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email_address))
$error = 'Debes introducir una dirección de correo electrónico válida.';
// check that a message was entered
elseif (empty($message))
$error = 'Debes introducir un mensaje.';
// check if an error was found - if there was, send the user back to the form
if (isset($error)) {
header('Location: contacto.html?e='.urlencode($error)); exit;
}
// write the email content
$email_content = "Nombre: $name\n";
$email_content .= "Email: $email_address\n";
$email_content .= "Mensaje:\n\n$message";
// send the email replace "your email address here" with your email. Keep the ""!
mail ("info@climbo.info", "Nuevo mensaje de contacto", $email_content);
// send the user back to the form
header('Location: contacto.html?s='.urlencode('Gracias por tu mensaje.')); exit;
?>