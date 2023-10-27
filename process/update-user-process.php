<?php
include_once("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $editedName = mysqli_real_escape_string($conn, $_POST["editedName"]);
    $editedApellido = mysqli_real_escape_string($conn, $_POST["editedApellido"]);
    $editedEmail = mysqli_real_escape_string($conn, $_POST["editedEmail"]);

    // Verificar si se ingresó una nueva contraseña
    $editedPassword = $_POST["editedPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if (!empty($editedPassword) && !empty($confirmPassword)) {
        if ($editedPassword === $confirmPassword) {
            // La contraseña ha sido actualizada, genera su hash
            $editedPassword = password_hash($editedPassword, PASSWORD_DEFAULT);
        } else {
            $_SESSION["error_message"] = "Las contraseñas no coinciden";
            header("Location: ../pages/editar.php?id=$userId");
            exit();
        }
    }

    // Verificar si el correo electrónico ya existe en otro registro
    $query = "SELECT id FROM usuarios WHERE mail = ? AND id <> ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $editedEmail, $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION["error_message"] = "El correo electrónico ya está en uso.";
        header("Location: ../pages/editar.php?id=$userId");
        exit();
    }

    // Actualiza los datos en la base de datos
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, mail = ?";
    $paramTypes = "sss";
    $paramValues = array($editedName, $editedApellido, $editedEmail);

    // Agregar la contraseña si se proporcionó una nueva
    if (!empty($editedPassword)) {
        $query .= ", contrasena = ?";
        $paramTypes .= "s";
        $paramValues[] = $editedPassword;
    }

    $query .= " WHERE id = ?";
    $paramTypes .= "i";
    $paramValues[] = $userId;

    $stmt = mysqli_prepare($conn, $query);

    // Use call_user_func_array para vincular los parámetros dinámicamente
    $bindParams = array_merge(array($stmt, $paramTypes), $paramValues);
    call_user_func_array('mysqli_stmt_bind_param', $bindParams);

    if (mysqli_stmt_execute($stmt)) {
        $mensaje = "Usuario actualizado con éxito";
        header("Location: ../pages/editar.php?id=$userId&mensaje=$mensaje");
        exit();
    } else {
        $_SESSION["error_message"] = "Error al actualizar el usuario: " . mysqli_error($conn);
        header("Location: ../pages/editar.php?id=$userId");
        exit();
    }
}
