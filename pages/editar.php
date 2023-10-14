<?php
session_start();

if (!isset($_SESSION["nombreUsuario"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../database/database.php");

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $usuario = $_SESSION["usuario"]; 

    // Consulta SQL para actualizar los datos del usuario
    $query = "UPDATE login SET nombre=?, correo=? WHERE usuario=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $correo, $usuario);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<?php include('../includes/header.php'); ?>
<div class="usuario-container">
    <div class="perfil">
        <h2>Editar Información del Usuario <?php echo $usuario; ?>"></h2>
        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombreUsuario; ?>">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" value="<?php echo $correoUsuario; ?>">
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
