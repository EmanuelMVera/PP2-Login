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
        }
    }

    // Si llegamos aquí, hay un error en el inicio de sesión
    $_SESSION["loginError"] = true;
    header("Location: ../index.php");
}
?>
