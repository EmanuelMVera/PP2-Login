<?php
session_start();
require_once('../TCPDF-main/tcpdf.php');
include('../database/database.php');

// Recupera los datos filtrados y la configuración de ordenamiento desde la variable de sesión
$filteredData = $_SESSION['filteredData'];
$sortColumn = $_SESSION['sortColumn'];
$fromDate = $_SESSION['fromDate'];
$toDate = $_SESSION['toDate'];

// Crear una instancia de TCPDF
$pdf = new TCPDF();
$pdf->SetCreator('Ema');
$pdf->SetAuthor('Ema');
$pdf->SetTitle('Tabla de Usuarios');
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();

// Encabezado del PDF
$html = '
<h1 style="text-align:center;">Tabla de Usuarios</h1>
<table border="1" cellspacing="0" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Correo Electrónico</th>
    <th>Teléfono</th>
    <th>Fecha de Creación</th>
</tr>';

foreach ($filteredData as $row) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id'] . '</td>';
    $html .= '<td>' . $row['nombre'] . '</td>';
    $html .= '<td>' . $row['apellido'] . '</td>';
    $html .= '<td>' . $row['mail'] . '</td>';
    $html .= '<td>' . $row['telefono'] . '</td>';
    $html .= '<td>' . $row['fecha_creacion_formato'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Agrega el contenido al PDF
$pdf->writeHTML($html, true, 0, true, 0);

// Cierra la conexión a la base de datos
mysqli_close($conn);

// Salida del PDF: Descargar el archivo
$pdf->Output('tabla_usuarios.pdf', 'D');

?>