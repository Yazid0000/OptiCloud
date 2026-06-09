<?php
require("../connexion.php");
require("../fonctions.php");
$idmarque    = trim(isset($_POST['idmarque'])    ? $_POST['idmarque']    : '');
$nom         = trim(isset($_POST['nom'])         ? $_POST['nom']         : '');
$pays        = trim(isset($_POST['pays'])        ? $_POST['pays']        : '');
$description = trim(isset($_POST['description']) ? $_POST['description'] : '');
$stmt = mysqli_prepare($con, "UPDATE marque SET nom=?, pays=?, description=? WHERE idmarque=?");
mysqli_stmt_bind_param($stmt, "ssss", $nom, $pays, $description, $idmarque);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("marque_list.php");
