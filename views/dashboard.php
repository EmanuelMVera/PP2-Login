<!-- dashboard.php -->
<?php include('../includes/header.php'); ?>

<div class="mainContainer">
    <div class="usuario-container">
        <div class="perfil">
            <h2 class="leftTitle">Lista de Usuarios</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include('../controllers/dashboard-controller.php'); ?>
                </tbody>
            </table>
            <form action="../process/logout-process.php" method="post">
                <button type="submit" class="btn">Salir</button>
            </form>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
