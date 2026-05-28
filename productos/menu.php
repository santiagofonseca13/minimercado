<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Módulo Productos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.card {
    border-radius: 15px;
    transition: 0.3s;
}

.card:hover {
    transform: scale(1.05);
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

    <h2 class="mb-4 text-center">📦 Módulo de Productos</h2>

    <div class="row g-4">

        
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h4>➕ Crear Producto</h4>
                <p>Registrar nuevos productos</p>
                <a href="crear.php" class="btn btn-success">Ir</a>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h4>📋 Ver Productos</h4>
                <p>Lista completa de productos</p>
                <a href="listar.php?modo=ver" class="btn btn-primary">Ir</a>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h4>✏️ Editar Productos</h4>
                <p>Modificar información</p>
                <a href="listar.php?modo=editar" class="btn btn-warning">Ir</a>
            </div>
        </div>

    </div>

    
    <div class="text-center mt-5">
        <a href="../dashboard.php" class="btn btn-dark px-4">⬅ Volver al Dashboard</a>
    </div>

</div>

</body>
</html>