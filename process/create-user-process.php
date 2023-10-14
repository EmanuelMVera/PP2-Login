<?php
include_once("../database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = mysqli_real_escape_string($conn, trim($_POST["newUserName"]));
    $userEmail = mysqli_real_escape_string($conn, trim($_POST["newUserEmail"]));

    // Realiza la inserción del nuevo usuario en la base de datos
    $query = "INSERT INTO login (nombre, correo) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail);

    if (mysqli_stmt_execute($stmt)) {
        // Redirige de nuevo a dashboard con un mensaje de éxito
        header("Location: ../pages/dashboard.php?mensaje=Nuevo usuario creado exitosamente.");
        exit();
    } else {
        echo "Error al crear el nuevo usuario: " . mysqli_error($conn);
    }
}
?>