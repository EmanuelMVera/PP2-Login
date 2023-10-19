<?php include('../includes/header.php'); ?>

<div class="mainContainer">
    <div class="leftPage">
        <h1 class="leftTitle">Práctica</h1>
        <div class="loginContainer">
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
                </div>
                <button type="submit" class="btn">Ingresar</button>
            </form>
        </div>
    </div>
    <div class="rightPage">
        <h1 class="rightTitle">Profesional II</h1>
        <div class="registerContainer">
            <form action="../process/register-process.php" method="POST">
                <div class="form-group">
                    <input type="text" name="usuario" placeholder="Usuario" required />
                </div>
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required />
                </div>
                <div class="form-group">
                    <input type="email" name="correo" placeholder="Correo electrónico" required />
                </div>
                <div class="form-group">
                    <input type="password" name="contrasena" placeholder="Contraseña" required />
                </div>
                <button type="submit" class="btn">Registrar</button>
            </form>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
