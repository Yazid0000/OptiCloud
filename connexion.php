<?php
$con = mysqli_connect("localhost", "root", "", "opticloud");
if (!$con) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");
?>
