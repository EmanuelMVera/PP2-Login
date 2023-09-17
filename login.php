<?php
include_once("includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Verificar si el usuario y la contraseña existen en la base de datos
    $query = "SELECT * FROM login WHERE usuario = '$usuario' AND password = '$contrasena'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Inicia la sesión y guarda los datos del usuario en la sesión
        session_start();

        $row = mysqli_fetch_assoc($result);
        $_SESSION["nombreUsuario"] = $row['nombre'];
        $_SESSION["correoUsuario"] = $row['correo'];
        $_SESSION["fechaNacimiento"] = $row['fecha_nacimiento'];
        $_SESSION["ciudad"] = $row['ciudad'];
        $_SESSION["pais"] = $row['pais'];

        // Redirige a usuario.php
        header("Location: usuario.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>
