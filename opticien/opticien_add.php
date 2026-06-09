<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$idopticien      = intval(isset($_POST['idopticien'])      ? $_POST['idopticien']      : 0);
$nommagasin      = trim(isset($_POST['nommagasin'])        ? $_POST['nommagasin']      : '');
$responsable     = trim(isset($_POST['responsable'])       ? $_POST['responsable']     : '');
$telephone       = trim(isset($_POST['telephone'])         ? $_POST['telephone']       : '');
$email           = trim(isset($_POST['email'])             ? $_POST['email']           : '');
$adresse         = trim(isset($_POST['adresse'])           ? $_POST['adresse']         : '');
$ville           = trim(isset($_POST['ville'])             ? $_POST['ville']           : '');
$pays            = trim(isset($_POST['pays'])              ? $_POST['pays']            : 'Maroc');
$dateinscription = trim(isset($_POST['dateinscription'])   ? $_POST['dateinscription'] : '');
$statut          = trim(isset($_POST['statut'])            ? $_POST['statut']          : 'actif');
$license         = trim(isset($_POST['license'])           ? $_POST['license']         : '');
$mdp_raw         = trim(isset($_POST['motdepasse'])        ? $_POST['motdepasse']      : '');
if ($dateinscription === '') { $dateinscription = null; }
$motdepasse = ($mdp_raw !== '') ? password_hash($mdp_raw, PASSWORD_DEFAULT) : '';
if ($idopticien <= 0 || empty($nommagasin) || empty($responsable) || empty($license)) {
    redirection("ajouter_form.php");
}
$stmt = mysqli_prepare($con,
    "INSERT INTO opticien (idopticien, nommagasin, responsable, telephone, email, adresse, ville, pays, dateinscription, statut, license, motdepasse)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "isssssssssss",
    $idopticien, $nommagasin, $responsable, $telephone, $email,
    $adresse, $ville, $pays, $dateinscription, $statut, $license, $motdepasse);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("opticien_list.php");
