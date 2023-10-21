<?php
include_once("../database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $editedName = mysqli_real_escape_string($conn, $_POST["editedName"]);
    $editedEmail = mysqli_real_escape_string($conn, $_POST["editedEmail"]);

    $query = "UPDATE login SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $editedName, $editedEmail, $userId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../views/dashboard.php?mensaje=Usuario actualizado con éxito");
        exit();
    } else {
        echo "Error al actualizar el usuario: " . mysqli_error($conn);
    }
}
?>