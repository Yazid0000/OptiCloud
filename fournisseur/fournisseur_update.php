<?php
require("../connexion.php");
require("../fonctions.php");
$idfournisseur = intval(isset($_POST['idfournisseur']) ? $_POST['idfournisseur'] : 0);
$nom           = trim(isset($_POST['nom'])           ? $_POST['nom']           : '');
$responsable   = trim(isset($_POST['responsable'])   ? $_POST['responsable']   : '');
$adresse       = trim(isset($_POST['adresse'])       ? $_POST['adresse']       : '');
$ville         = trim(isset($_POST['ville'])         ? $_POST['ville']         : '');
$telephone     = trim(isset($_POST['telephone'])     ? $_POST['telephone']     : '');
$email         = trim(isset($_POST['email'])         ? $_POST['email']         : '');
$stmt = mysqli_prepare($con, "UPDATE fournisseur SET nom=?, responsable=?, adresse=?, ville=?, telephone=?, email=? WHERE idfournisseur=?");
mysqli_stmt_bind_param($stmt, "ssssssi", $nom, $responsable, $adresse, $ville, $telephone, $email, $idfournisseur);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("fournisseur_list.php");
