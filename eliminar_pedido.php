<?php
include 'conexion.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM pedidos WHERE id = $id";
    $conexion->query($sql);
}

header("Location: ver_pedidos.php");
exit();
?>
