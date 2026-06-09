<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /www/OPTI_CLOUD_PHP5/login.php");
    exit();
}
?>