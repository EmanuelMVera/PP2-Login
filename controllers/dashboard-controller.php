<?php
include('../models/UserModel.php');
$users = UserModel::getAllUsers();

foreach ($users as $user) {
    $idUsuario = htmlspecialchars($user['id']);
    $nombreUsuario = htmlspecialchars($user['nombre']);
    $correoUsuario = htmlspecialchars($user['correo']);

    echo "<tr>";
    echo "<td>$idUsuario</td>";
    echo "<td contenteditable='true'>$nombreUsuario</td>";
    echo "<td contenteditable='true'>$correoUsuario</td>";
    echo "<td><a href='../pages/editar.php?id=$idUsuario'><i class='fas fa-edit'></i></a> | <a href='../pages/delete.php?id=$idUsuario'><i class='fas fa-trash'></i></a></td>";
    echo "</tr>";
}
