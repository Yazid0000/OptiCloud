<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$reference     = trim(isset($_POST['reference'])     ? $_POST['reference']     : '');
$modele        = trim(isset($_POST['modele'])        ? $_POST['modele']        : '');
$couleur       = trim(isset($_POST['couleur'])       ? $_POST['couleur']       : '');
$materiau      = trim(isset($_POST['materiau'])      ? $_POST['materiau']      : '');
$genre         = trim(isset($_POST['genre'])         ? $_POST['genre']         : '');
$description   = trim(isset($_POST['description'])   ? $_POST['description']   : '');
$prix          = floatval(isset($_POST['prix'])       ? $_POST['prix']         : 0);
$stock         = intval(isset($_POST['stock'])        ? $_POST['stock']        : 0);
$idmarque      = trim(isset($_POST['idmarque'])       ? $_POST['idmarque']     : '');
$idfournisseur = intval(isset($_POST['idfournisseur'])? $_POST['idfournisseur']: 0);
$idcategorie   = trim(isset($_POST['idcategorie'])    ? $_POST['idcategorie']  : '');
if ($genre        === '') { $genre        = null; }
if ($idmarque     === '') { $idmarque     = null; }
if ($idfournisseur == 0)  { $idfournisseur= null; }
if ($idcategorie  === '') { $idcategorie  = null; }
if (empty($reference)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con,
    "INSERT INTO monture (reference, modele, couleur, materiau, genre, prix, stock, idmarque, idfournisseur, idcategorie, description)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssdiisis",
    $reference, $modele, $couleur, $materiau, $genre,
    $prix, $stock, $idmarque, $idfournisseur, $idcategorie, $description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("monture_list.php");
