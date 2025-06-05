<?php
include 'conexion.php';

$busqueda = $_GET['busqueda'];
$busqueda = $_GET['busqueda'];
$sql = "SELECT * FROM pedidos WHERE id LIKE '%$busqueda%' OR producto LIKE '%$busqueda%'";
$resultado = $conexion->query($sql);

echo "<h2>Resultados de búsqueda:</h2>";
echo "<table border='1'>
<tr><th>ID</th><th>Cliente</th><th>Producto</th><th>Fecha</th><th>Estado</th></tr>";

while ($row = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['cliente']}</td>
            <td>{$row['producto']}</td>
            <td>{$row['fecha']}</td>
            <td>{$row['estado']}</td>
          </tr>";
}
echo "</table>";
?>