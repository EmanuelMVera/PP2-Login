<?php
include_once("../database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];
    $query = "DELETE FROM login WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../views/dashboard.php?mensaje=Usuario eliminado con éxito");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conn);
    }
}
