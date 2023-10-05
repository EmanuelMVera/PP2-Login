<?php include('../includes/header.php'); ?>
<div class="content">
    <div class="main-container">
        <h2>Iniciar sesión</h2>
        <?php
        // Mostrar mensaje de error si existe
        if (isset($error)) {
            echo '<div class="error-message">' . $error . '</div>';
        }
        ?>
        <form action="../process/login-process.php" method="POST">
            <div class="form-group">
                <input type="text" name="user" placeholder="Usuario..." required />
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Contraseña..." required>
                <button type="button" id="password-toggle-button">Mostrar contraseña</button>
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
        <a href="./register.php">Crear usuario</a>
    </div>
</div>
<?php include('../includes/footer.php'); ?>