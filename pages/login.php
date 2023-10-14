<?php include('../includes/header.php'); ?>
<div class="container">
    <div class="main-container">
        <h2 class="tittle">Iniciar sesión</h2>
        <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            echo '<div class="error-message">' . htmlspecialchars($error) . '</div>';
        }
        ?>
        <form action="../process/login-process.php" method="POST" class="main-form">
            <div class="form-group">
                <input type="text" name="user" placeholder="Usuario..." required />
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Contraseña..." required>
            </div>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</div>
<?php include('../includes/footer.php'); ?>