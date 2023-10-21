<?php
include_once("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"]));
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $correo = mysqli_real_escape_string($conn, trim($_POST["correo"]));
    $contrasena = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT);

    // Validación de datos
    $error = false;

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    }

    // Verificar si el usuario ya existe
    $query = "SELECT id FROM login WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
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
    $query = "INSERT INTO login (usuario, password, nombre, correo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $usuario, $contrasena, $nombre, $correo);

    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige a la página de inicio de sesión con mensaje
        $_SESSION["registrationSuccess"] = true;
        header("Location: ../pages/login.php");
        exit();
    }
}
