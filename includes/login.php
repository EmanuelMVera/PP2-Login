<div class="loginContainer">
    <form action="../process/login-process.php" method="POST" id="loginForm">
        <div class="form-group">
            <input type="text" name="user" placeholder="Correo electrónico..." required <?php if (isset($_SESSION["loginError"])) {
                echo 'class="error"';
                unset($_SESSION["loginError"]);
            } ?> />
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Contraseña..." required <?php if (isset($_SESSION["loginError"])) {
                echo 'class="error"';
                unset($_SESSION["loginError"]);
            } ?> />
        </div>
        <button type="submit" class="btn">Ingresar</button>
    </form>
</div>

<!-- <script src="../assets/js/form-validation.js"></script> -->