<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}


$modo = isset($_GET['modo']) ? $_GET['modo'] : 'ver';

$resultado = $conexion->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html>
<head>
<title>Lista de Productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2>Lista de Productos</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>

            <!-- 🔥 SOLO EN MODO EDITAR -->
            <?php if($modo == 'editar'){ ?>
                <th>Acción</th>
            <?php } ?>
        </tr>

        <?php while($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['descripcion']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['stock']; ?></td>

            
            <?php if($modo == 'editar'){ ?>
            <td>
                <a href="editar.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-warning btn-sm">
                   Editar
                </a>
            </td>
            <?php } ?>

        </tr>
        <?php } ?>

    </table>

    <a href="menu.php" class="btn btn-secondary">Volver</a>
</div>

</body>
</html>