<?php
require("../auth.php");
require("../connexion.php");
$id = intval(isset($_GET['id']) ? $_GET['id'] : 0);
if ($id > 0) {
    $stmt = mysqli_prepare($con, "DELETE FROM fournisseur WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
header("Location: fournisseur_list.php");
exit();
