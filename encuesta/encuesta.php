<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}


if($_POST){
    $usuario = $_SESSION['usuario'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO encuestas (usuario, calificacion, comentario)
            VALUES ('$usuario', '$calificacion', '$comentario')";

    if($conexion->query($sql)){
        $mensaje = "Gracias por tu opinión 🙌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Encuesta</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.card { border-radius: 15px; }
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

    <div class="card shadow p-4 col-md-6 mx-auto">
        <h3 class="mb-3 text-center">📝 Encuesta de Satisfacción</h3>

        <?php if(isset($mensaje)) echo "<div class='alert alert-success'>$mensaje</div>"; ?>

        <form method="POST">

            <label>¿Cómo calificas el sistema?</label>
            <select name="calificacion" class="form-control mb-3" required>
                <option value="">Selecciona</option>
                <option value="5">Excelente ⭐⭐⭐⭐⭐</option>
                <option value="4">Bueno ⭐⭐⭐⭐</option>
                <option value="3">Regular ⭐⭐⭐</option>
                <option value="2">Malo ⭐⭐</option>
                <option value="1">Muy Malo ⭐</option>
            </select>

            <label>Comentario</label>
            <textarea name="comentario" class="form-control mb-3" placeholder="Escribe tu opinión..."></textarea>

            <button class="btn btn-primary w-100">Enviar Encuesta</button>

        </form>

        <a href="../dashboard.php" class="btn btn-secondary mt-3">⬅ Volver</a>
    </div>

</div>

</body>
</html>