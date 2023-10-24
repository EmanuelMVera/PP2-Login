<?php
session_start();

// Verificar si los datos del usuario están presentes en la sesión
if (isset($_SESSION["nombreUsuario"])) {
    include("../database/database.php");

    // Obtener todos los usuarios de la base de datos
    $query = "SELECT id, nombre, apellido, mail, telefono, DATE_FORMAT(fecha_creacion, '%d/%m/%Y %H:%i:%s') AS fecha_creacion_formato FROM usuarios";
    $result = mysqli_query($conn, $query);


    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idUsuario = $row['id'];
            $nombreUsuario = $row['nombre'];
            $apellidoUsuario = $row['apellido'];
            $correoUsuario = $row['mail'];
            $telefonoUsuario = $row['telefono'];
            $fechaCreacion = $row['fecha_creacion_formato'];

            // Mostrar cada usuario en una fila de la tabla con un enlace de Editar
            echo "<tr>";
            echo "<td>$idUsuario</td>";
            echo "<td contenteditable='true'>$nombreUsuario</td>";
            echo "<td contenteditable='true'>$apellidoUsuario</td>";
            echo "<td contenteditable='true'>$correoUsuario</td>";
            echo "<td contenteditable='true'>$telefonoUsuario</td>";
            echo "<td>$fechaCreacion</td>";
            echo "<td><a href='../pages/editar.php?id=$idUsuario'><i class='fas fa-edit'></i></a> | <a href='../pages/delete.php?id=$idUsuario'><i class='fas fa-trash'></i></a></td>";
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