<?php include('../includes/header.php'); ?>
<?php session_start(); ?>
<div class="mainContainer">
    <div class="leftPage">
        <h1 class="leftTitle">Práctica</h1>
        <div class="loginContainer">
            <form action="../process/login-process.php" method="POST" id="loginForm">
                <div class="form-group">
                    <input type="text" name="user" placeholder="Correo electrónico..." required <?php if(isset($_SESSION["loginError"])) { echo 'class="error"'; unset($_SESSION["loginError"]); } ?> />
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Contraseña..." required <?php if(isset($_SESSION["loginError"])) { echo 'class="error"'; unset($_SESSION["loginError"]); } ?> />
                </div>
                <button type="submit" class="btn">Ingresar</button>
            </form>
        </div>
    </div>
    <div class="rightPage">
        <h1 class="rightTitle">Profesional II</h1>
        <div class="registerContainer"> 
            <form action="../process/register-process.php" method="POST" id="registerForm">
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required <?php if(isset($_SESSION["registerError"])) { echo 'class="error"'; unset($_SESSION["registerError"]); } ?> />
                </div>
                <div class="form-group">
                    <input type="text" name="apellido" placeholder="Apellido" required <?php if(isset($_SESSION["registerError"])) { echo 'class="error"'; unset($_SESSION["registerError"]); } ?> />
                </div>
                <div class="form-group">
                    <input type="text" name="telefono" placeholder="Teléfono" <?php if(isset($_SESSION["registerError"])) { echo 'class="error"'; unset($_SESSION["registerError"]); } ?> />
                </div>
                <div class="form-group">
                    <input type="email" name="correo" placeholder="Correo electrónico" required <?php if(isset($_SESSION["registerError"])) { echo 'class="error"'; unset($_SESSION["registerError"]); } ?> />
                </div>
                <div class="form-group">
                    <input type="password" name="contrasena" placeholder="Contraseña" required <?php if(isset($_SESSION["registerError"])) { echo 'class="error"'; unset($_SESSION["registerError"]); } ?> />
                </div>
                <button type="submit" class="btn">Registrar</button>
            </form>
            <?php if(isset($_SESSION["registrationSuccess"])) { echo '<p class="success-text">Registro exitoso.</p>'; unset($_SESSION["registrationSuccess"]); } ?>
        </div>
    </div>
</div>
<!-- <script src="../assets/js/form-validation.js"></script> -->
<?php include('../includes/footer.php'); ?>
