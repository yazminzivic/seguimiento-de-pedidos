<?php
if (isset($_GET['email']) && isset($_GET['pass'])) {
    $email = htmlspecialchars($_GET['email']);
    $nueva_password = htmlspecialchars($_GET['pass']);
} else {
    // Acceso inválido
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contraseña actualizada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 80px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        p {
            font-size: 1.1rem;
            color: #555;
            margin: 10px 0 25px;
        }
        .password {
            font-size: 2rem;
            color: #28a745; /* Verde */
            font-weight: 700;
            margin-bottom: 30px;
        }
        a.login-btn {
            background-color: #007BFF;
            color: white;
            padding: 14px 30px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        a.login-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contraseña restablecida con éxito</h2>
    <p>Tu nueva contraseña para <strong><?php echo $email; ?></strong> es:</p>
    <p class="password"><?php echo $nueva_password; ?></p>

    <a href="index.php" class="login-btn">Iniciar sesión</a>
</div>

</body>
</html>
