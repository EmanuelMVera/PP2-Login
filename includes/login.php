<div class="loginContainer">
    <form action="../process/login-process.php" method="POST" id="loginForm">
        <div class="form-group">
            <input type="text" name="user" placeholder="Correo electrónico..." required />
            <p class="errorBox">
                <?php if (isset($_SESSION["loginErrorUser"])) {
                    echo $_SESSION["loginErrorUser"];
                    unset($_SESSION["loginErrorUser"]);
                } ?>
            </p>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Contraseña..." required />
            <p class="errorBox">
                <?php if (isset($_SESSION["loginErrorPass"])) {
                    echo $_SESSION["loginErrorPass"];
                    unset($_SESSION["loginErrorPass"]);
                } ?>
            </p>
        </div>
        <button type="submit" class="btn">Ingresar</button>
    </form>
</div>

<!-- <script src="../assets/js/form-validation.js"></script> -->