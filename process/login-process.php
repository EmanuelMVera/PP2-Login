<?php
include_once("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["user"]));
    $contrasena = trim($_POST["password"]);

    $query = "SELECT * FROM login WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['password'])) {
            $_SESSION["nombreUsuario"] = $row['nombre'];
            $_SESSION["correoUsuario"] = $row['correo'];

            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>