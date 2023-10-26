<?php
include_once("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = mysqli_real_escape_string($conn, trim($_POST["user"]));
    $contrasena = trim($_POST["password"]);

    $query = "SELECT * FROM usuarios WHERE mail = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['contrasena'])) {
            // Almacenar los datos del usuario en la sesión
            $_SESSION["idUsuario"] = $row['id'];
            $_SESSION["nombreUsuario"] = $row['nombre'];
            $_SESSION["apellidoUsuario"] = $row['apellido'];
            $_SESSION["telefonoUsuario"] = $row['telefono'];
            $_SESSION["correoUsuario"] = $row['mail'];

            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            // Contraseña incorrecta
            $_SESSION["loginErrorPass"] = "La contraseña ingresada es incorrecta.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        // Usuario no existe
        $_SESSION["loginErrorUser"] = "El usuario ingresado no existe.";
        header("Location: ../index.php");
        exit();
    }
}
?>
