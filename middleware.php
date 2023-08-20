<?php
include_once './connection.php';

class RoleMiddleware {
    public static function checkRole($role) {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
            header("Location: login.php");
            exit();
        }
    }
}
?>
