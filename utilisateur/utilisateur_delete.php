<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Empêcher la suppression de son propre compte
if ($id > 0 && $id != $_SESSION['user_id']) {
    mysqli_query($con, "DELETE FROM utilisateurs WHERE id = $id");
}
header("Location: /www/OPTI_CLOUD_PHP5/utilisateur/utilisateur_list.php");
exit();
?>