<?php
session_start();

// Verifica si los datos del usuario están presentes en la sesión
if (isset($_SESSION["nombreUsuario"])) {
    // Los datos del usuario están presentes en la sesión
    include("../database/database.php"); // Incluye la conexión a la base de datos si es necesario

    // Obtén los datos del usuario de la base de datos si están disponibles
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
        // Utiliza una consulta preparada para mayor seguridad
        $query = "SELECT 
                    nombre, 
                    correo, 
                    fecha_nacimiento
                  FROM login WHERE usuario = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["nombreUsuario"] = $row['nombre'];
            $_SESSION["correoUsuario"] = $row['correo'];
            $_SESSION["fechaNacimiento"] = $row['fecha_nacimiento'];
        }
    }

    // Valores por defecto si los datos no están en la tabla o la sesión
    $nombreUsuario = $_SESSION["nombreUsuario"];
    $correoUsuario = $_SESSION["correoUsuario"];
    $fechaNacimiento = $_SESSION["fechaNacimiento"];

    // Cierra la conexión a la base de datos cuando hayas terminado de usarla
    mysqli_close($conn);

} else {
    // Los datos del usuario no están en la sesión, redirige al inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>

<?php include('../includes/header.php'); ?>
<div class="usuario-container">
    <div class="perfil">
        <h2>
            <?php echo $nombreUsuario; ?>
        </h2>
        <p>Correo Electrónico:
            <?php echo $correoUsuario; ?>
        </p>
        <p>Fecha de Nacimiento:
            <?php echo $fechaNacimiento; ?>
        </p>
        <form action="index.php">
            <button type="submit">Salir</button>
        </form>
    </div>
</div>
<?php include('./includes/footer.php'); ?>