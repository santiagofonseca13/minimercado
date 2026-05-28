<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}


if(!isset($_GET['id'])){
    header("Location: listar.php");
}

$id = $_GET['id'];


if($_POST){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    if($nombre != "" && $precio != "" && $stock != ""){
        $sql = "UPDATE productos SET
                nombre='$nombre',
                descripcion='$descripcion',
                precio='$precio',
                stock='$stock'
                WHERE id=$id";

        if($conexion->query($sql)){
            $mensaje = "Producto actualizado correctamente";
        } else {
            $error = "Error al actualizar";
        }
    } else {
        $error = "Todos los campos obligatorios";
    }
}


$resultado = $conexion->query("SELECT * FROM productos WHERE id=$id");
$producto = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Producto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}
.card {
    border-radius: 15px;
}
</style>

</head>

<body>


<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Mini Mercado</span>
        <span class="text-white">👤 <?php echo $_SESSION['usuario']; ?></span>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow p-4">
        <h3 class="mb-3">✏️ Editar Producto</h3>

        <?php if(isset($mensaje)) echo "<div class='alert alert-success'>$mensaje</div>"; ?>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">

            <label>Nombre</label>
            <input name="nombre" value="<?php echo $producto['nombre']; ?>" 
                   class="form-control mb-2" required>

            <label>Descripción</label>
            <input name="descripcion" value="<?php echo $producto['descripcion']; ?>" 
                   class="form-control mb-2">

            <label>Precio</label>
            <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" 
                   class="form-control mb-2" required>

            <label>Stock</label>
            <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" 
                   class="form-control mb-3" required>

            <button class="btn btn-warning">Actualizar</button>
            <a href="listar.php?modo=editar" class="btn btn-secondary">Volver</a>

        </form>
    </div>

</div>

</body>
</html>