<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
    exit;
}

$productos = $conexion->query("SELECT * FROM productos");

if($_POST){

    $productos_ids = $_POST['producto'];
    $cantidades = $_POST['cantidad'];

    $total_venta = 0;

    
    $conexion->query("INSERT INTO ventas(total) VALUES(0)");
    $id_venta = $conexion->insert_id;

    for($i=0; $i<count($productos_ids); $i++){

        $id_producto = $productos_ids[$i];
        $cantidad = $cantidades[$i];

        
        if(empty($id_producto) || empty($cantidad)){
            echo "<div class='alert alert-danger'>Stock insuficiente</div>";
            exit;
        }

        
        $p = $conexion->query("SELECT * FROM productos WHERE id=$id_producto")->fetch_assoc();

        
        if(!$p){
            echo "<div class='alert alert-danger'>Stock insuficiente</div>";
            exit;
        }

        
        if($p['stock'] < $cantidad){
            echo "<div class='alert alert-danger'>Stock insuficiente</div>";
            exit;
        }

        $precio = $p['precio'];
        $subtotal = $precio * $cantidad;
        $total_venta += $subtotal;

        
        $conexion->query("INSERT INTO detalle_ventas(id_venta,id_producto,cantidad,precio)
                          VALUES($id_venta,$id_producto,$cantidad,$precio)");

        
        $nuevo_stock = $p['stock'] - $cantidad;
        $conexion->query("UPDATE productos SET stock=$nuevo_stock WHERE id=$id_producto");
    }

    
    $conexion->query("UPDATE ventas SET total=$total_venta WHERE id=$id_venta");

    $mensaje = "Venta registrada correctamente";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Registrar Venta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
function agregarProducto(){

    let fila = `
    <div class="row mb-2">
        <div class="col">
            <select name="producto[]" class="form-control">

                <?php 
                $productos2 = $conexion->query("SELECT * FROM productos");

                while($p = $productos2->fetch_assoc()) {
                ?>

                <option value="<?php echo $p['id']; ?>">
                    <?php echo $p['nombre']; ?> 
                    (Stock: <?php echo $p['stock']; ?>)
                </option>

                <?php } ?>

            </select>
        </div>

        <div class="col">
            <input type="number" 
                   name="cantidad[]" 
                   class="form-control" 
                   placeholder="Cantidad"
                   required>
        </div>
    </div>
    `;

    document.getElementById("productos").innerHTML += fila;
}
</script>

</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Registrar Venta</h2>

    <?php 
    if(isset($mensaje)){
        echo "<div class='alert alert-success'>$mensaje</div>";
    }
    ?>

    <form method="POST">

        <div id="productos">

            <div class="row mb-2">

                <div class="col">

                    <select name="producto[]" class="form-control">

                        <?php while($row = $productos->fetch_assoc()) { ?>

                            <option value="<?php echo $row['id']; ?>">

                                <?php echo $row['nombre']; ?> 
                                (Stock: <?php echo $row['stock']; ?>)

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="col">

                    <input type="number" 
                           name="cantidad[]" 
                           class="form-control" 
                           placeholder="Cantidad"
                           required>

                </div>

            </div>

        </div>

        <button type="button" 
                onclick="agregarProducto()" 
                class="btn btn-info mb-2">

            ➕ Agregar otro producto

        </button>

        <br>

        <button class="btn btn-success">
            Registrar Venta
        </button>

        <a href="menu.php" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

</body>
</html>