<?php
include_once("includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $contrasena = $_POST["contrasena"];

    // Verificar si el usuario ya existe en la base de datos
    $checkQuery = "SELECT usuario FROM login WHERE usuario = '$usuario'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    } else {
        // Hash de la contraseña
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $insertQuery = "INSERT INTO login (usuario, password) VALUES ('$usuario', '$hashedPassword')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Registro exitoso, redirige al usuario a la página de inicio de sesión
            header("Location: index.html");
            exit();
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
?>
