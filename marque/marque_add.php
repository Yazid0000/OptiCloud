<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$idmarque    = strtoupper(trim(isset($_POST['idmarque'])    ? $_POST['idmarque']    : ''));
$nom         = trim(isset($_POST['nom'])         ? $_POST['nom']         : '');
$pays        = trim(isset($_POST['pays'])        ? $_POST['pays']        : '');
$description = trim(isset($_POST['description']) ? $_POST['description'] : '');
if (empty($idmarque) || empty($nom)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con, "INSERT INTO marque (idmarque, nom, pays, description) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $idmarque, $nom, $pays, $description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("marque_list.php");
