<?php
include_once("includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $contrasena = $_POST["contrasena"];

    // Verificar si el usuario y la contraseña existen en la base de datos
    $query = "SELECT * FROM login WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['password'])) {
            // Inicia la sesión y guarda los datos del usuario en la sesión
            session_start();

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
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>


<?php include('../templates/header.php'); ?>
<div class="content">
    <div class="main-container">
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required /><br />
            <input type="password" name="contrasena" placeholder="Contraseña" required /><br />
            <button type="submit">Ingresar</button>
        </form>
        <a href="registro.html">Crear usuario</a>
    </div>
</div>
<?php include('../templates/footer.php'); ?>