<?php
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $userId = $_GET["id"];
    include('../includes/header.php');
    ?>
    <div class="usuario-container">
        <div class="perfil">
            <h2 class="tittle-dashboard">Editar Usuario</h2>
            <?php
            if (isset($_GET["mensaje"])) {
                $mensaje = $_GET["mensaje"];
                echo '<p class="mensaje">' . htmlspecialchars($mensaje) . '</p>';
            }
            ?>
            <form action="../process/update-user-process.php" method="POST">
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                <input type="text" name="editedName" placeholder="Nombre" required>
                <input type="text" name="editedEmail" placeholder="Correo Electrónico" required>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>
    <?php include('../includes/footer.php'); ?>
<?php
} else {
    echo "ID de usuario no válido.";
}
?>