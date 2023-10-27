<?php
// Incluye el archivo de la base de datos
include_once("../database/database.php");
// Inicia la sesión
session_start();

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y limpia los datos del formulario
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $apellido = mysqli_real_escape_string($conn, trim($_POST["apellido"]));
    $correo = mysqli_real_escape_string($conn, trim($_POST["correo"]));
    // Genera un hash de contraseña segura
    $contrasena = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT);

    // Validación de datos
    $error = false;

    // Verifica si el correo es válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $_SESSION["registerError"] = 'Correo electrónico no válido';
    }

    // Verifica si el correo ya está registrado
    $query = "SELECT id FROM usuarios WHERE mail = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $error = true;
        $_SESSION["registerError"] = 'El correo ya está registrado';
    }

    if ($error) {
        // Redirige a la página de registro en caso de error
        header("Location: ../register.php");
        exit();
    }

    // Inserción de usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, apellido, mail, contrasena) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $correo, $contrasena);

    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige a la página de registro con mensaje de éxito
        $_SESSION["registrationSuccess"] = 'Registro exitoso!!!';
        header("Location: ../register.php");
        exit();
    } else {
        // Error inesperado al registrar
        $_SESSION["registerError"] = 'Ocurrió un error inesperado al registrar.';
        header("Location: ../register.php");
        exit();
    }
}
?>
