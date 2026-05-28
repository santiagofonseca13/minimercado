<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
    exit;
}

if($_POST){

    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    
    $buscar = $conexion->query("SELECT * FROM productos 
                                WHERE nombre='$nombre'");

    
    if($buscar->num_rows > 0){

        
        $producto = $buscar->fetch_assoc();

        
        $nuevo_stock = $producto['stock'] + $stock;

        
        $sql = "UPDATE productos 
                SET stock='$nuevo_stock',
                    precio='$precio',
                    descripcion='$descripcion'
                WHERE id=".$producto['id'];

        $conexion->query($sql);

        $mensaje = "Stock actualizado correctamente";

    } else {

        
        $sql = "INSERT INTO productos(nombre, descripcion, precio, stock)
                VALUES('$nombre','$descripcion','$precio','$stock')";

        if($conexion->query($sql)){
            $mensaje = "Producto guardado correctamente";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Crear Producto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Crear Producto</h2>

    <?php 
    if(isset($mensaje)){
        echo "<div class='alert alert-success'>$mensaje</div>";
    }
    ?>

    <form method="POST">

        <input name="nombre"
               class="form-control mb-2"
               placeholder="Nombre"
               required>

        <input name="descripcion"
               class="form-control mb-2"
               placeholder="Descripción">

        <input name="precio"
               type="number"
               step="0.01"
               class="form-control mb-2"
               placeholder="Precio"
               required>

        <input name="stock"
               type="number"
               class="form-control mb-2"
               placeholder="Stock"
               required>

        <button class="btn btn-success">
            Guardar
        </button>

        <a href="menu.php" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

</body>
</html>