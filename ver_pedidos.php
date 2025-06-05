<?php
include 'conexion.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : "";
$pedidos = [];
$mensaje = "";

if ($busqueda !== "") {
    $stmt = $conexion->prepare("SELECT * FROM pedidos WHERE id = ? OR producto LIKE ?");
    $busquedaProducto = "%" . $busqueda . "%";
    $stmt->bind_param("is", $busqueda, $busquedaProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if (!empty($fila['cliente']) || !empty($fila['producto']) || !empty($fila['fecha']) || !empty($fila['estado'])) {
                $pedidos[] = $fila;
            }
        }
    } else {
        $mensaje = "🔍 No se encontró ningún pedido con ese ID o producto.";
    }
    $stmt->close();
} else {
    $resultado = $conexion->query("SELECT * FROM pedidos ORDER BY id DESC");
    while ($fila = $resultado->fetch_assoc()) {
        if (!empty($fila['cliente']) || !empty($fila['producto']) || !empty($fila['fecha']) || !empty($fila['estado'])) {
            $pedidos[] = $fila;
        }
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Pedidos</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <div class="container">
    <h1>📋 Lista de Pedidos</h1>

    <form action="ver_pedidos.php" method="GET" style="margin-bottom: 20px;">
      <input type="text" name="busqueda" placeholder="Buscar por ID o producto" value="<?php echo htmlspecialchars($busqueda); ?>">
      <button type="submit">Buscar</button>
    </form>

    <?php if ($mensaje !== ""): ?>
      <p><?php echo $mensaje; ?></p>
    <?php elseif (count($pedidos) > 0): ?>
      <table border="1" cellpadding="8" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $pedido): ?>
            <tr>
              <td><?php echo str_pad($pedido['id'], 2, '0', STR_PAD_LEFT); ?></td>
              <td><?php echo htmlspecialchars($pedido['cliente']); ?></td>
              <td><?php echo htmlspecialchars($pedido['producto']); ?></td>
              <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
              <td><?php echo htmlspecialchars($pedido['estado']); ?></td>
              <td>
                <!-- Formulario para eliminar -->
                <form action="eliminar_pedido.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                  <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este pedido?');">Eliminar</button>
                </form>

                <!-- Formulario para modificar -->
                <form action="modificar_estado.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                  <select name="estado">
                    <option value="pendiente" <?php if ($pedido['estado'] === 'pendiente') echo 'selected'; ?>>Pendiente</option>
                    <option value="enviado" <?php if ($pedido['estado'] === 'enviado') echo 'selected'; ?>>Enviado</option>
                    <option value="entregado" <?php if ($pedido['estado'] === 'entregado') echo 'selected'; ?>>Entregado</option>
                  </select>
                  <button type="submit">Modificar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No hay pedidos registrados.</p>
    <?php endif; ?>

    <br>
    <a href="inicio.php">⬅ Volver al inicio</a>
  </div>
</body>
</html>
