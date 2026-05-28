<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.card {
    transition: 0.3s;
    border-radius: 15px;
}

.card:hover {
    transform: scale(1.05);
}

.icon {
    font-size: 40px;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Mini Mercado</span>
        <span class="text-white">👤 <?php echo $_SESSION['usuario']; ?></span>
    </div>
</nav>

<!-- CONTENIDO -->
<div class="container mt-5">

    <h2 class="mb-4">Bienvenido <?php echo $_SESSION['usuario']; ?> 👋</h2>

    <div class="row g-4">

        <!-- PRODUCTOS -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="icon">📦</div>
                <h4>Módulo Productos</h4>
                <p>Gestiona productos</p>
                <a href="productos/menu.php" class="btn btn-primary">Ir</a>
            </div>
        </div>

        <!-- VENTAS -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="icon">💰</div>
                <h4>Módulo Ventas</h4>
                <p>Registrar y consultar ventas</p>
                <a href="ventas/menu.php" class="btn btn-success">Ir</a>
            </div>
        </div>

        <!-- INVENTARIO -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="icon">📊</div>
                <h4>Inventario</h4>
                <p>Ver estado del stock</p>
                <a href="reportes/inventario.php" class="btn btn-warning">Ir</a>
            </div>
        </div>
         <div class="card shadow text-center p-4">
        <div class="icon">📝</div>
        <h4>Encuesta</h4>
        <p>Califica el sistema</p>
        <a href="encuesta/encuesta.php" class="btn btn-info">Ir</a>
    </div>
</div>

    </div>
    <div class="col-md-4">
   

    <!-- BOTÓN CERRAR SESIÓN -->
    <div class="text-center mt-5">
        <a href="logout.php" class="btn btn-danger px-4">Cerrar sesión</a>
    </div>

</div>


</body>
</html>