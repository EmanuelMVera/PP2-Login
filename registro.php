<?php
include_once("./includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"]));
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $correo = mysqli_real_escape_string($conn, trim($_POST["correo"]));
    $fecha_nacimiento = mysqli_real_escape_string($conn, trim($_POST["fecha_nacimiento"]));
    $contrasena = trim($_POST["contrasena"]);

    // Hash de la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    $query = "INSERT INTO login (usuario, password, nombre, correo, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $usuario, $hashed_password, $nombre, $correo, $fecha_nacimiento);

    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige a la página de inicio de sesión
        header("Location: index.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conn);
    }
}
?>

<!-- Formulario de registro -->
<?php include('./templates/header.php'); ?>
<div class="registro-container">
    <h2>Crear usuario</h2>
    <form action="registro.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required /><br />
        <input type="text" name="nombre" placeholder="Nombre" required /><br />
        <input type="email" name="correo" placeholder="Correo electrónico" required /><br />
        <input type="date" name="fecha_nacimiento" required /><br />
        <input type="password" name="contrasena" placeholder="Contraseña" required /><br />
        <button type="submit">Registrar</button>
    </form>
    <a href="./index.php">Volver al inicio de sesión</a>
</div>
<?php include('./templates/footer.php'); ?>