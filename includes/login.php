<?php
include_once("./database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"])); // Aplicamos trim() al nombre de usuario
    $contrasena = trim($_POST["contrasena"]); // Aplicamos trim() a la contraseña

    // Verificar si el usuario y la contraseña existen en la base de datos
    $query = "SELECT * FROM login WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['password'])) {
            // Guarda los datos del usuario en la sesión
            $_SESSION["nombreUsuario"] = $row['nombre'];
            $_SESSION["correoUsuario"] = $row['correo'];
            $_SESSION["fechaNacimiento"] = $row['fecha_nacimiento'];
            $_SESSION["ciudad"] = $row['ciudad'];
            $_SESSION["pais"] = $row['pais'];

            // Redirige a perfil.php
            header("Location: ../perfil.php");
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
        <a href="../registro.php">Crear usuario</a>
    </div>
</div>
<?php include('../templates/footer.php'); ?>