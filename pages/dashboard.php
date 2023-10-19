<?php include('../includes/header.php'); ?>

<div class="usuario-container">
    <div class="perfil">
        <h2 class="tittle-dashboard">Lista de Usuarios</h2>
        <?php
        if (isset($_GET["mensaje"])) {
            $mensaje = $_GET["mensaje"];
            echo '<p class="mensaje">' . htmlspecialchars($mensaje) . '</p>';
        }
        ?>
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
                <?php include('../process/dashboard-data.php'); ?>
            </tbody>
        </table>
        <form action="../process/logout-process.php" method="post">
            <button type="submit">Salir</button>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
