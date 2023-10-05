<?php
include_once("../database/database.php");

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
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conn);
    }
}
?>

