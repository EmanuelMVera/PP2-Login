<?php
include("../database/database.php");
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $userId = $_GET["id"];
    include('../includes/header.php');

    $mensajeClass = "";
    $mensajeTexto = "";

    if (isset($_GET["mensaje"])) {
        $mensajeClass = "mensaje";
        $mensajeTexto = $_GET["mensaje"];
    }

    if (isset($_SESSION["error_message"])) {
        $mensajeClass = "errorBox";
        $mensajeTexto = $_SESSION["error_message"];
        unset($_SESSION["error_message"]);
    }

    // Obtén los valores existentes del usuario desde la base de datos
    $query = "SELECT nombre, apellido, mail FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $correo = $row["mail"];
    }
    ?>
    <div class="mainContainer">
        <div class="usuario-container">
            <div class="perfil">
                <h2 class="leftTitle">Editar Usuario</h2>
                <form action="../process/update-user-process.php" method="POST">
                    <div class="seccionSuperiro">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <input class="input-field" type="text" name="editedName" placeholder="Nombre"
                            value="<?php echo $nombre; ?>" required>
                        <input class="input-field" type="text" name="editedApellido" placeholder="Apellido"
                            value="<?php echo $apellido; ?>" required>
                        <input class="input-field" type="text" name="editedEmail" placeholder="Correo Electrónico"
                            value="<?php echo $correo; ?>" required>
                        <input class="input-field" type="password" name="editedPassword" placeholder="Nueva Contraseña">
                        <input class="input-field" type="password" name="confirmPassword"
                            placeholder="Confirmar Contraseña">
                    </div>

                    <div class="seccionInferior">
                        <button class="btn" type="submit">Guardar Cambios</button>
                        <a class="btn-cancel" href="../pages/dashboard.php">Cancelar</a>
                        <p class="<?php echo $mensajeClass; ?>">
                            <?php echo htmlspecialchars($mensajeTexto); ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('../includes/footer.php');
} else {
    echo "ID de usuario no válido.";
}
