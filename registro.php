<?php 
include("conexion.php");

if($_POST){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    
    $check = $conexion->query("SELECT * FROM usuarios WHERE username='$user'");

    if($check->num_rows > 0){
        $error = "El usuario ya existe";
    } else {
        $conexion->query("INSERT INTO usuarios(username,password) VALUES('$user','$pass')");
        $success = "Usuario registrado correctamente";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 350px;">
    <h3 class="text-center mb-3">Registro</h3>

    <form method="POST">
        <input type="text" name="username" class="form-control mb-2" placeholder="Usuario" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>

        <button class="btn btn-success w-100">Registrarse</button>
    </form>

    <?php 
    if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>";
    if(isset($success)) echo "<p class='text-success mt-2'>$success</p>";
    ?>

    <hr>
    <a href="index.php" class="btn btn-outline-dark w-100">Volver al login</a>
</div>

</body>
</html>