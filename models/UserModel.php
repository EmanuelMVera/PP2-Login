<?php
session_start();
if (isset($_SESSION["nombreUsuario"])) {
    class UserModel
    {
        public static function getAllUsers()
        {
            include("../database/database.php");
            $query = "SELECT id, nombre, correo FROM login";
            $result = mysqli_query($conn, $query);
            $users = array();

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
            }

            mysqli_close($conn);
            return $users;
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>