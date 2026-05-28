<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Módulo Ventas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.card:hover {
    transform: scale(1.05);
    transition: 0.3s;
}
</style>

</head>

<body>


<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Mini Mercado</span>
        <span class="text-white">Usuario: <?php echo $_SESSION['usuario']; ?></span>
    </div>
</nav>


<div class="container mt-5">

    <h2 class="mb-4 text-center">Módulo de Ventas</h2>

    <div class="row">

        <!-- Crear venta -->
        <div class="col-md-6">
            <div class="card shadow text-center p-3">
                <h4>💰 Registrar Venta</h4>
                <p>Registrar una nueva venta</p>
                <a href="crear.php" class="btn btn-success">Ir</a>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card shadow text-center p-3">
                <h4>📊 Ver Ventas</h4>
                <p>Historial de ventas</p>
                <a href="listar.php" class="btn btn-primary">Ir</a>
            </div>
        </div>

    </div>

    
    <div class="text-center mt-5">
        <a href="../dashboard.php" class="btn btn-dark">⬅ Volver al Dashboard</a>
    </div>

</div>

</body>
</html>