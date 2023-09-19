<?php
session_start(); // Inicia la sesión

// Verifica si los datos del usuario están presentes en la sesión
if (isset($_SESSION["nombreUsuario"])) {
    // Los datos del usuario están presentes en la sesión
    include("includes/database.php"); // Incluye la conexión a la base de datos si es necesario

    // Obtén los datos del usuario de la base de datos si están disponibles
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];

        $query = "SELECT 
                    nombre, 
                    correo, 
                    fecha_nacimiento, 
                    ciudad, 
                    pais
                  FROM login WHERE usuario = '$usuario'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $nombreUsuario = $row['nombre'];
            $correoUsuario = $row['correo'];
            $fechaNacimiento = $row['fecha_nacimiento'];
            $ciudad = $row['ciudad'];
            $pais = $row['pais'];
        }
    }

    // Valores por defecto si los datos no están en la tabla o la sesión
    if (!isset($nombreUsuario)) {
        $nombreUsuario = "Nombre no especificado";
    }

    if (!isset($correoUsuario)) {
        $correoUsuario = "Correo no especificado";
    }

    if (!isset($fechaNacimiento)) {
        $fechaNacimiento = "Fecha de nacimiento no especificada";
    }

    if (!isset($ciudad)) {
        $ciudad = "Ciudad no especificada";
    }

    if (!isset($pais)) {
        $pais = "País no especificado";
    }
} else {
    // Los datos del usuario no están en la sesión, redirige al inicio de sesión
    header("Location: ./index.php");
    exit();
}

?>

<?php include('./templates/header.php'); ?>
<div class="usuario-container">
    <div class="perfil">
        <img src="avatar.png" alt="Foto de perfil">
        <h2>
            <?php echo $nombreUsuario; ?>
        </h2>
        <p>Correo Electrónico:
            <?php echo $correoUsuario; ?>
        </p>
        <p>Fecha de Nacimiento:
            <?php echo $fechaNacimiento; ?>
        </p>
        <p>Ciudad:
            <?php echo $ciudad; ?>
        </p>
        <p>País:
            <?php echo $pais; ?>
        </p>
        <form action="index.php">
            <button type="submit">Salir</button>
        </form>
    </div>
</div>
<?php include('./templates/footer.php'); ?>