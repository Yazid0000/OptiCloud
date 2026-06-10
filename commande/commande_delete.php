<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($con, "DELETE FROM commande_detail WHERE commande_id = $id");
    mysqli_query($con, "DELETE FROM commande WHERE id = $id");
}
header("Location: /www/OPTI_CLOUD_PHP5/commande/commande_list.php");
exit();
?>