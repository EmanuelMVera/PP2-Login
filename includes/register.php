<div class="registerContainer">
    <form action="../process/register-process.php" method="POST" id="registerForm">
        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" required <?php if (isset($_SESSION["registerError"]))
                echo 'class="error"'; ?> />
        </div>
        <div class="form-group">
            <input type="text" name="apellido" placeholder="Apellido" required <?php if (isset($_SESSION["registerError"]))
                echo 'class="error"'; ?> />
        </div>
        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" required <?php if (isset($_SESSION["registerError"]))
                echo 'class="error"'; ?> />
        </div>
        <div class="form-group">
            <input type="password" name="contrasena" placeholder="Contraseña" required <?php if (isset($_SESSION["registerError"]))
                echo 'class="error"'; ?> />
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
    <p <?php
    if (isset($_SESSION["registerError"])) {
        echo 'class="errorBox"';
        echo '>';
        echo $_SESSION["registerError"];
        unset($_SESSION["registerError"]);
    } elseif (isset($_SESSION["registrationSuccess"])) {
        echo 'class="success-text"';
        echo '>';
        echo $_SESSION["registrationSuccess"];
        unset($_SESSION["registrationSuccess"]);
    } else {
        echo '>';
    }
    ?></p>
</div>