<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$nom         = trim(isset($_POST['nom'])         ? $_POST['nom']         : '');
$responsable = trim(isset($_POST['responsable']) ? $_POST['responsable'] : '');
$adresse     = trim(isset($_POST['adresse'])     ? $_POST['adresse']     : '');
$ville       = trim(isset($_POST['ville'])       ? $_POST['ville']       : '');
$telephone   = trim(isset($_POST['telephone'])   ? $_POST['telephone']   : '');
$email       = trim(isset($_POST['email'])       ? $_POST['email']       : '');
if (empty($nom) || empty($responsable)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con, "INSERT INTO fournisseur (nom, responsable, adresse, ville, telephone, email) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssss", $nom, $responsable, $adresse, $ville, $telephone, $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("fournisseur_list.php");
