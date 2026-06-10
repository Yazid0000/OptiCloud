<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($con, "DELETE FROM rendezvous WHERE id = $id");
}
header("Location: /www/OPTI_CLOUD_PHP5/rendezvous/rendezvous_list.php");
exit();
?>