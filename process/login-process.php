<?php
// Incluye el archivo de base de datos
include_once("../database/database.php");
// Inicia la sesión
session_start();

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y limpia el correo del usuario
    $mail = mysqli_real_escape_string($conn, trim($_POST["user"]));
    // Obtiene la contraseña sin procesar
    $contrasena = trim($_POST["password"]);

    // Consulta para buscar al usuario por correo
    $query = "SELECT * FROM usuarios WHERE mail = ?";
    $stmt = mysqli_prepare($conn, $query);
    // Vincula el valor del correo al parámetro en la consulta
    mysqli_stmt_bind_param($stmt, "s", $mail);
    // Ejecuta la consulta preparada
    mysqli_stmt_execute($stmt);
    // Obtiene el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        // Si se encuentra un usuario con el correo proporcionado
        $row = mysqli_fetch_assoc($result);
        // Verifica si la contraseña ingresada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $row['contrasena'])) {
            // Almacena los datos del usuario en la sesión
            $_SESSION["idUsuario"] = $row['id'];
            $_SESSION["nombreUsuario"] = $row['nombre'];
            $_SESSION["apellidoUsuario"] = $row['apellido'];
            $_SESSION["correoUsuario"] = $row['mail'];

            // Redirige al usuario a la página de inicio del dashboard
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
