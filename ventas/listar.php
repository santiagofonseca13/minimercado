<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}

$sql = "SELECT v.id, v.fecha, v.total, p.nombre, d.cantidad
        FROM ventas v
        JOIN detalle_ventas d ON v.id = d.id_venta
        JOIN productos p ON p.id = d.id_producto";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Ventas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2>Historial de Ventas</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>

        <?php while($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fecha']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>

    </table>

    <a href="menu.php" class="btn btn-secondary">Volver</a>
</div>

</body>
</html>