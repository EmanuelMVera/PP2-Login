<?php
// Inicia la sesión
session_start();

// Cierra la sesión actual
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header("Location: ../index.php");
exit();
?>