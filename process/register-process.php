<?php
include_once("../database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"])); // Cambiado de "user" a "usuario"
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $correo = mysqli_real_escape_string($conn, trim($_POST["correo"]));
    $contrasena = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT); // Cambiado de "password" a "contrasena"

    // Validación de datos
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de correo electrónico no válido";
        header("Location: ../pages/login.php?error=" . urlencode($error));
        exit();
    }

    // Verificar si el usuario ya existe
    $query = "SELECT id FROM login WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $error = "El usuario ya existe. Por favor, elige otro nombre de usuario.";
        header("Location: ../pages/login.php?error=" . urlencode($error));
        exit();
    }

    // Inserción de usuario
    $query = "INSERT INTO login (usuario, password, nombre, correo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $usuario, $contrasena, $nombre, $correo);

    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige a la página de inicio de sesión con mensaje
        header("Location: ../pages/login.php?registro=exitoso");
        exit();
    } else {
        // Error al registrar el usuario
        $error = "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        header("Location: ../pages/login.php?error=" . urlencode($error));
        exit();
    }
}
?>
