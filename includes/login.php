<?php
include_once("./database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, trim($_POST["usuario"]));
    $contrasena = trim($_POST["contrasena"]);

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
            $_SESSION["fechaNacimiento"] = $row['fecha_nacimiento'];
            $_SESSION["ciudad"] = $row['ciudad'];
            $_SESSION["pais"] = $row['pais'];

            header("Location: ../perfil.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<?php include('../templates/header.php'); ?>
<div class="content">
    <div class="main-container">
        <h2>Iniciar sesión</h2>
        <?php
        // Mostrar mensaje de error si existe
        if (isset($error)) {
            echo '<div class="error-message">' . $error . '</div>';
        }
        ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" name="usuario" placeholder="Usuario" required />
            </div>
            <div class="form-group">
                <input type="password" name="contrasena" placeholder="Contraseña" required />
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
        <a href="../registro.php">Crear usuario</a>
    </div>
</div>
<?php include('../templates/footer.php'); ?>