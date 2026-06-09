<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$idverre     = trim(isset($_POST['idverre'])     ? $_POST['idverre']     : '');
$nom         = trim(isset($_POST['nom'])         ? $_POST['nom']         : '');
$type        = trim(isset($_POST['type'])        ? $_POST['type']        : '');
$traitement  = trim(isset($_POST['traitement'])  ? $_POST['traitement']  : '');
$description = trim(isset($_POST['description']) ? $_POST['description'] : '');
$prix        = floatval(isset($_POST['prix'])    ? $_POST['prix']        : 0);
$indice_raw  = isset($_POST['indice'])           ? $_POST['indice']      : '';
$indice      = ($indice_raw !== '') ? floatval($indice_raw) : null;
$idmarque    = trim(isset($_POST['idmarque'])    ? $_POST['idmarque']    : '');
if ($idmarque === '') { $idmarque = null; }
if (empty($idverre) || empty($nom)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con,
    "INSERT INTO verre (idverre, nom, type, indice, traitement, prix, idmarque, description)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssdssss",
    $idverre, $nom, $type, $indice, $traitement, $prix, $idmarque, $description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("verre_list.php");
