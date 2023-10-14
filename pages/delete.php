<?php
session_start();

if (!isset($_SESSION["nombreUsuario"])) {
    header("Location: ../index.php");
    exit();
}
?>

<?php include('../includes/header.php'); ?>
<div class="usuario-container">
    <div class="perfil">
        <h2>Eliminar Usuario</h2>
        <p>¿Estás seguro de que deseas eliminar tu cuenta?</p>
        <form action="../process/eliminar-process.php" method="post">
            <button type="submit">Eliminar Cuenta</button>
        </form>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
