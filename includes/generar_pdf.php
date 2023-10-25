<?php
if (isset($_GET['download']) && $_GET['download'] == 1) {
    // Realizar la generación y descarga del PDF
    require_once('../TCPDF-main/tcpdf.php');
    include('../database/database.php');

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

    // Obtén los datos de la tabla de usuarios desde la base de datos
    $query = "SELECT id, nombre, apellido, mail, telefono, DATE_FORMAT(fecha_creacion, '%d/%m/%Y %H:%i:%s') AS fecha_creacion_formato FROM usuarios";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
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
} else {
    // Muestra el contenido normal de la página
    echo 'Haga clic en el enlace para descargar el PDF.';
}
?>
