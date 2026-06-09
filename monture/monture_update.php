<?php
require("../connexion.php");
require("../fonctions.php");
$idmonture     = intval(isset($_POST['idmonture'])     ? $_POST['idmonture']     : 0);
$reference     = trim(isset($_POST['reference'])       ? $_POST['reference']     : '');
$modele        = trim(isset($_POST['modele'])          ? $_POST['modele']        : '');
$couleur       = trim(isset($_POST['couleur'])         ? $_POST['couleur']       : '');
$materiau      = trim(isset($_POST['materiau'])        ? $_POST['materiau']      : '');
$genre         = trim(isset($_POST['genre'])           ? $_POST['genre']         : '');
$description   = trim(isset($_POST['description'])     ? $_POST['description']   : '');
$prix          = floatval(isset($_POST['prix'])         ? $_POST['prix']         : 0);
$stock         = intval(isset($_POST['stock'])          ? $_POST['stock']        : 0);
$idmarque      = trim(isset($_POST['idmarque'])         ? $_POST['idmarque']     : '');
$idfournisseur = intval(isset($_POST['idfournisseur'])  ? $_POST['idfournisseur']: 0);
$idcategorie   = trim(isset($_POST['idcategorie'])      ? $_POST['idcategorie']  : '');
if ($genre        === '') { $genre        = null; }
if ($idmarque     === '') { $idmarque     = null; }
if ($idfournisseur == 0)  { $idfournisseur= null; }
if ($idcategorie  === '') { $idcategorie  = null; }
$stmt = mysqli_prepare($con,
    "UPDATE monture SET reference=?, modele=?, couleur=?, materiau=?, genre=?,
     prix=?, stock=?, idmarque=?, idfournisseur=?, idcategorie=?, description=?
     WHERE idmonture=?");
mysqli_stmt_bind_param($stmt, "sssssdiisisi",
    $reference, $modele, $couleur, $materiau, $genre,
    $prix, $stock, $idmarque, $idfournisseur, $idcategorie, $description, $idmonture);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("monture_list.php");
