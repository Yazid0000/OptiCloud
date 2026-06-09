<?php
require("../connexion.php");
require("../fonctions.php");
$id = intval(isset($_GET['id']) ? $_GET['id'] : 0);
$stmt = mysqli_prepare($con, "DELETE FROM fournisseur WHERE idfournisseur = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("fournisseur_list.php");
