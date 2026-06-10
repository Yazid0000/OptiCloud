<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($con, "DELETE FROM prescription WHERE id = $id");
}
header("Location: /www/OPTI_CLOUD_PHP5/prescription/prescription_list.php");
exit();
?>