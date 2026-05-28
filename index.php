<?php 
session_start();
include("conexion.php");

if($_POST){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$user' AND password='$pass'";
    $res = $conexion->query($sql);

    if($res->num_rows > 0){
        $_SESSION['usuario'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 350px;">
    <h3 class="text-center mb-3">Iniciar Sesión</h3>

    <form method="POST">
        <input type="text" name="username" class="form-control mb-2" placeholder="Usuario" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>

        <button class="btn btn-primary w-100">Ingresar</button>
    </form>

    <?php if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>

    <hr>
    <p class="text-center">¿No tienes cuenta?</p>
    <a href="registro.php" class="btn btn-outline-secondary w-100">Registrarse</a>
</div>

</body>
</html>