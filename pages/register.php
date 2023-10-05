<?php include('../includes/header.php'); ?>
<div class="registro-container">
    <h2>Crear usuario</h2>
    <form action="../process/register-process.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required /><br />
        <input type="text" name="nombre" placeholder="Nombre" required /><br />
        <input type="email" name="correo" placeholder="Correo electrónico" required /><br />
        <input type="date" name="fecha_nacimiento" required /><br />
        <input type="password" name="contrasena" placeholder="Contraseña" required /><br />
        <button type="submit">Registrar</button>
    </form>
    <a href="../index.php">Volver al inicio de sesión</a>
</div>
<?php include('../includes/footer.php'); ?>