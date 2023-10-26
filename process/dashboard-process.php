<?php
session_start();
include("../database/database.php");

// Variables para ordenar y filtrar
$sortColumn = "nombre";
$fromDate = "";
$toDate = "";

$sortColumn = "nombre"; // Valor por defecto
if (isset($_GET["sort"])) {
    $sortColumn = $_GET["sort"];
}

if (isset($_GET["from-date"])) {
    $fromDate = $_GET["from-date"];
}

if (isset($_GET["to-date"])) {
    $toDate = $_GET["to-date"];
}

// Obtener todos los usuarios de la base de datos con orden y filtro
$query = "SELECT id, nombre, apellido, mail, telefono, DATE_FORMAT(fecha_creacion, '%d/%m/%Y %H:%i:%s') AS fecha_creacion_formato 
          FROM usuarios ";

// Verifica si se han establecido fechas para aplicar el filtro
if (!empty($fromDate) && !empty($toDate)) {
    $query .= "WHERE DATE(fecha_creacion) BETWEEN ? AND ? ";
}

$query .= "ORDER BY $sortColumn";
          
$stmt = mysqli_prepare($conn, $query);

// Si se han establecido fechas, enlaza los parámetros
if (!empty($fromDate) && !empty($toDate)) {
    mysqli_stmt_bind_param($stmt, "ss", $fromDate, $toDate);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $filteredData = array(); // Almacena los datos filtrados

    while ($row = mysqli_fetch_assoc($result)) {
        // Mostrar cada usuario en una fila de la tabla
        $idUsuario = $row['id'];
        $nombreUsuario = $row['nombre'];
        $apellidoUsuario = $row['apellido'];
        $correoUsuario = $row['mail'];
        $telefonoUsuario = $row['telefono'];
        $fechaCreacion = $row['fecha_creacion_formato'];

        // Agregar los datos a la matriz de datos filtrados
        $filteredData[] = array(
            'id' => $idUsuario,
            'nombre' => $nombreUsuario,
            'apellido' => $apellidoUsuario,
            'mail' => $correoUsuario,
            'telefono' => $telefonoUsuario,
            'fecha_creacion_formato' => $fechaCreacion
        );

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

    // Almacena los datos filtrados y la configuración de ordenamiento en la variable de sesión
    $_SESSION['filteredData'] = $filteredData;
    $_SESSION['sortColumn'] = $sortColumn;
    $_SESSION['fromDate'] = $fromDate;
    $_SESSION['toDate'] = $toDate;
}

// Cierra la conexión a la base de datos cuando hayas terminado de usarla
mysqli_close($conn);
?>
