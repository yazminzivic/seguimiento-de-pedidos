<?php
if (isset($_GET['email']) && isset($_GET['nueva'])) {
    $email = $_GET['email'];
    $nueva_clara = $_GET['nueva'];
    $nueva_hash = password_hash($nueva_clara, PASSWORD_DEFAULT);

    $conex = mysqli_connect("localhost", "root", "", "registro");
    if (!$conex) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $sql = "UPDATE registronuevo SET pass = '$nueva_hash' WHERE email = '$email'";
    if (mysqli_query($conex, $sql)) {
        $mensaje = "La nueva contraseña ha sido activada correctamente.";
    } else {
        $mensaje = "Error al actualizar la contraseña.";
    }

    mysqli_close($conex);
} else {
    $mensaje = "Solicitud no válida.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Recuperación</title>
</head>
<body>

<h2>Resultado:</h2>
<p><?php echo $mensaje; ?></p>
<p><a href="index.php">Volver al inicio de sesión</a></p>

</body>
</html>
