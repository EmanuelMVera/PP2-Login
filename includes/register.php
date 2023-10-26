<div class="registerContainer">
    <form action="../process/register-process.php" method="POST" id="registerForm">
        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" required <?php if (isset($_SESSION["registerError"])) {
                echo 'class="error"';
                unset($_SESSION["registerError"]);
            } ?> />
        </div>
        <div class="form-group">
            <input type="text" name="apellido" placeholder="Apellido" required <?php if (isset($_SESSION["registerError"])) {
                echo 'class="error"';
                unset($_SESSION["registerError"]);
            } ?> />
        </div>
        <div class="form-group">
            <input type="text" name="telefono" placeholder="Teléfono" <?php if (isset($_SESSION["registerError"])) {
                echo 'class="error"';
                unset($_SESSION["registerError"]);
            } ?> />
        </div>
        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" required <?php if (isset($_SESSION["registerError"])) {
                echo 'class="error"';
                unset($_SESSION["registerError"]);
            } ?> />
        </div>
        <div class="form-group">
            <input type="password" name="contrasena" placeholder="Contraseña" required <?php if (isset($_SESSION["registerError"])) {
                echo 'class="error"';
                unset($_SESSION["registerError"]);
            } ?> />
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
    <?php if (isset($_SESSION["registrationSuccess"])) {
        echo '<p class="success-text">Registro exitoso.</p>';
        unset($_SESSION["registrationSuccess"]);
    } ?>
</div>