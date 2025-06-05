<?php
include 'conexion.php';

$cliente = $_POST['cliente'];
$producto = $_POST['producto'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];

$sql = "INSERT INTO pedidos (cliente, producto, fecha, estado) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $cliente, $producto, $fecha, $estado);

if ($stmt->execute()) {
    header("Location: inicio.php");
} else {
    echo "Error al agregar pedido: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>

    <input type="text" name="cliente" placeholder="Cliente" required>
    <input type="text" name="producto" placeholder="Producto" required>
    <input type="date" name="fecha" required>
    <select name="estado">
      <option value="pendiente">Pendiente</option>
      <option value="enviado">Enviado</option>
      <option value="entregado">Entregado</option>
    </select>
    <button type="submit">Agregar Pedido</button>