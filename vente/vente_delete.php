<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($con, "DELETE FROM vente_detail WHERE vente_id = $id");
    mysqli_query($con, "DELETE FROM paiement WHERE vente_id = $id");
    mysqli_query($con, "DELETE FROM vente WHERE id = $id");
}
header("Location: /www/OPTI_CLOUD_PHP5/vente/vente_list.php");
exit();
?>