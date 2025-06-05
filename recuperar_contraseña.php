<?php
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["recuperar"])) {
    $email = trim($_POST["email"]);
    $conex = mysqli_connect("localhost", "root", "", "registro");

    if (!$conex) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM registronuevo WHERE correo = '$email'";
    $resultado = mysqli_query($conex, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        // Generar nueva contraseña
        $nueva_password = bin2hex(random_bytes(4)); // Ej: "a1b2c3d4"
        $hash = password_hash($nueva_password, PASSWORD_DEFAULT);

        // Actualizar contraseña en BD
        $update = "UPDATE registronuevo SET pass = '$hash' WHERE correo = '$email'";
        if (mysqli_query($conex, $update)) {
            // Redirigir a nueva_contraseña.php y pasar la nueva por GET
            header("Location: nueva_contraseña.php?email=" . urlencode($email) . "&pass=" . urlencode($nueva_password));
            exit();
        } else {
            $mensaje = "Error al actualizar la contraseña.";
        }
    } else {
        $mensaje = "El email ingresado no está registrado.";
    }

    mysqli_close($conex);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Recuperar contraseña</title>
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
        .recover-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 320px;
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
        input[type="email"] {
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="email"]:focus {
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
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="recover-container">
        <h2>Recuperar contraseña</h2>

        <?php if ($mensaje): ?>
            <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <form method="post" action="recuperar_contraseña.php" autocomplete="off">
            <label for="email">Ingresa tu email:</label>
            <input type="email" id="email" name="email" required />

            <input type="submit" name="recuperar" value="Recuperar" />
        </form>

        <div class="links">
            <a href="index.php">Volver al inicio de sesión</a>
        </div>
    </div>
</body>
</html>
