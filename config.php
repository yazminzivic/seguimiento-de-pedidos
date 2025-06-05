<?php
// Iniciar sesión solo si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir el autoload de Google Client
require_once 'vendor/autoload.php';

// Crear cliente de Google
$google_client = new Google_Client();

// Configurar credenciales
$google_client->setClientId('727283115644-7a620c038j7k3sv8hd57rrpkhpvulee8.apps.googleusercontent.com');
$google_client->setClientSecret('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');

// Establecer URI de redirección (este archivo debe coincidir con el URI configurado en la consola de Google)
$google_client->setRedirectUri('http://localhost/index.php');

// Solicitar permisos para email y perfil
$google_client->addScope('email');
$google_client->addScope('profile');
?>
