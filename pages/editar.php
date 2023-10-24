<?php
include("../database/database.php");
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $userId = $_GET["id"];
    include('../includes/header.php');

    // Obtén los valores existentes del usuario desde la base de datos
    $query = "SELECT nombre, apellido, mail, telefono FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $correo = $row["mail"];
        $telefono = $row["telefono"];
    }
    ?>
    <div class="mainContainer">
        <div class="usuario-container">
            <div class="perfil">
                <h2 class="leftTitle">Editar Usuario</h2>
                <?php
                if (isset($_GET["mensaje"])) {
                    $mensaje = $_GET["mensaje"];
                    echo '<p class="mensaje">' . htmlspecialchars($mensaje) . '</p>';
                }
                ?>
                <form action="../process/update-user-process.php" method="POST">
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                    <input class="input-field" type="text" name="editedName" placeholder="Nombre" value="<?php echo $nombre; ?>" required>
                    <input class="input-field" type="text" name="editedApellido" placeholder="Apellido" value="<?php echo $apellido; ?>" required>
                    <input class="input-field" type="text" name="editedEmail" placeholder="Correo Electrónico" value="<?php echo $correo; ?>" required>
                    <input class="input-field" type="text" name="editedTelefono" placeholder="Teléfono" value="<?php echo $telefono; ?>" required>
                    <input class="input-field" type="password" name="editedPassword" placeholder="Nueva Contraseña">
                    <input class="input-field" type="password" name="confirmPassword" placeholder="Confirmar Contraseña">
                    <button class="btn" type="submit">Guardar Cambios</button>
                    <a class="btn-cancel" href="../pages/dashboard.php">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <?php include('../includes/footer.php');
} else {
    echo "ID de usuario no válido.";
}
?>
