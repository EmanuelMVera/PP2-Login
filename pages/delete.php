<?php
include('../includes/header.php');
?>
<div class="mainContainer">
    <div class="usuario-container">
        <div class="perfil">
            <h2 class="leftTitle">Eliminar Usuario</h2>
            <?php
            if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
                $userId = $_GET["id"];
                echo '<p>¿Estás seguro de que deseas eliminar este usuario?</p>';
                echo '<a href="../process/delete-user-process.php?id=' . $userId . '" class="button-delete">Eliminar</a>';
                echo '<a href="../pages/dashboard.php" class="button-cancel">Cancelar</a>';
            } else {
                echo "ID de usuario no válido.";
            }
            ?>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
