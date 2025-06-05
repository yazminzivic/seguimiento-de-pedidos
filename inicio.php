<?php
session_start();

// Permitir acceso si usuario tradicional o sesión con Google (access_token)
if (!isset($_SESSION["usuario"]) && !isset($_SESSION['access_token'])) {
    header("Location: index.php");
    exit();
}

// Mostrar nombre según sesión (usuario o Google)
if (isset($_SESSION["usuario"])) {
    $nombreUsuario = $_SESSION["usuario"];
} elseif (isset($_SESSION['user_first_name'])) {
    $nombreUsuario = $_SESSION['user_first_name'];
} else {
    $nombreUsuario = "Usuario";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seguimiento de Pedidos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📋 Seguimiento de pedidos</h1>
        <h2>¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php">Cerrar sesión</a>

 <form action="agregar_pedido.php" method="POST">
    <input type="text" name="cliente" placeholder="Cliente" required>
    <input type="text" name="producto" placeholder="Producto" required>
    <input type="date" name="fecha" required>
    <select name="estado">
      <option value="pendiente">Pendiente</option>
      <option value="enviado">Enviado</option>
      <option value="entregado">Entregado</option>
    </select>
    <button type="submit">Agregar Pedido</button>
  </form>

  <form action="ver_pedidos.php" method="GET" style="margin-top: 10px;">
    <button type="submit">Ver Pedidos</button>
  </form>

</body>
</html>
