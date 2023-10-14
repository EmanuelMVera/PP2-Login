<?php
session_start();

if (!isset($_SESSION["nombreUsuario"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("../database/database.php");

    $usuario = $_SESSION["usuario"];

    $query = "DELETE FROM login WHERE usuario=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);

    if (mysqli_stmt_execute($stmt)) {
        $mensaje = "La cuenta se ha eliminado exitosamente.";
    } else {
        $mensaje = "Error al eliminar la cuenta: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: ../page/eliminar-page.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>