<?php
include_once("../database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $userId = $_GET["id"];
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../pages/dashboard.php?mensaje=Usuario eliminado con éxito");
            exit();
        } else {
            echo "Error al eliminar el usuario: " . mysqli_error($conn);
        }
    } else {
        echo "ID de usuario no válido.";
    }
}

