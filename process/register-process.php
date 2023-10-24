<?php
include_once("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $apellido = mysqli_real_escape_string($conn, trim($_POST["apellido"]));
    $telefono = mysqli_real_escape_string($conn, trim($_POST["telefono"]));
    $correo = mysqli_real_escape_string($conn, trim($_POST["correo"]));
    $contrasena = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT);

    // Validación de datos
    $error = false;

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    }

    // Verificar si el correo ya está registrado
    $query = "SELECT id FROM usuarios WHERE mail = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $error = true;
    }

    if ($error) {
        // Marcar los campos con error
        $_SESSION["registerError"] = true;
        header("Location: ../pages/login.php");
        exit();
    }

    // Inserción de usuario
    $query = "INSERT INTO usuarios (nombre, apellido, telefono, mail, contrasena) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $telefono, $correo, $contrasena);

    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige a la página de inicio de sesión con mensaje
        $_SESSION["registrationSuccess"] = true;
        header("Location: ../pages/login.php");
        exit();
    }
}
