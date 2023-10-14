<?php
session_start();

// Verificar si los datos del usuario están presentes en la sesión
if (isset($_SESSION["nombreUsuario"])) {
    include("../database/database.php");

    // Obtener todos los usuarios de la base de datos
    $query = "SELECT id, nombre, correo FROM login";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idUsuario = $row['id'];
            $nombreUsuario = $row['nombre'];
            $correoUsuario = $row['correo'];

            // Mostrar cada usuario en una fila de la tabla
            echo "<tr>";
            echo "<td>$idUsuario</td>";
            echo "<td>$nombreUsuario</td>";
            echo "<td>$correoUsuario</td>";
            echo "<td><a href='editar.php?id=$idUsuario'>Editar</a> | <a href='eliminar.php?id=$idUsuario'>Eliminar</a></td>";
            echo "</tr>";
        }
    }

    // Cierra la conexión a la base de datos cuando hayas terminado de usarla
    mysqli_close($conn);
} else {
    // Los datos del usuario no están en la sesión, redirige al inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>
