<?php
// Iniciar sesión solo si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir Google Client
require_once 'vendor/autoload.php';

// Configurar Google Client
$google_client = new Google_Client();
$google_client->setClientId('727283115644-7a620c038j7k3sv8hd57rrpkhpvulee8.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('http://localhost/index.php');
$google_client->addScope('email');
$google_client->addScope('profile');

// Redirigir si ya hay sesión activa
if (isset($_SESSION["usuario"]) || isset($_SESSION["access_token"])) {
    header("Location: inicio.php");
    exit();
}

// Inicializar mensaje y botón
$mensaje = "";
$login_button = '';

// Conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "", "registro");
if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Login tradicional
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM registronuevo WHERE usuario = '$usuario'";
    $result = mysqli_query($conex, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['pass'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["usuario"] = $usuario;
            header("Location: inicio.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}

// Login con Google
if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $_SESSION['user_first_name'] = $data['given_name'] ?? '';
        $_SESSION['user_last_name'] = $data['family_name'] ?? '';
        $_SESSION['user_email_address'] = $data['email'] ?? '';
        $_SESSION['user_image'] = $data['picture'] ?? '';

        header("Location: inicio.php");
        exit();
    }
}

// Mostrar botón si no hay sesión de Google
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="google-btn">Iniciar sesión con Google</a>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 340px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            text-align: left;
            margin-bottom: 6px;
            color: #555;
            font-weight: 600;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        input[type="submit"] {
            background-color: #007BFF;
            border: none;
            padding: 12px;
            font-size: 1rem;
            color: white;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .google-btn {
            background-color: #dd4b39;
            color: white;
            padding: 12px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            display: inline-block;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }
        .google-btn:hover {
            background-color: #c23321;
        }
        p.message {
            color: red;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .links {
            margin-top: 15px;
        }
        .links a {
            color: #007BFF;
            text-decoration: none;
            font-weight: 600;
            margin: 0 5px;
            display: inline-block;
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>

        <?php if ($mensaje): ?>
            <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <form action="index.php" method="post" autocomplete="off">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required />

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required />

            <input type="submit" name="login" value="Iniciar sesión" />
        </form>

        <?php echo $login_button; ?>

        <div class="links">
            <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a><br />
            <a href="recuperar_contraseña.php">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>
