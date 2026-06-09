<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$idlentille    = trim(isset($_POST['idlentille'])    ? $_POST['idlentille']    : '');
$nom           = trim(isset($_POST['nom'])           ? $_POST['nom']           : '');
$type          = trim(isset($_POST['type'])          ? $_POST['type']          : '');
$materiau      = trim(isset($_POST['materiau'])      ? $_POST['materiau']      : '');
$correction    = trim(isset($_POST['correction'])    ? $_POST['correction']    : '');
$couleur       = trim(isset($_POST['couleur'])       ? $_POST['couleur']       : '');
$description   = trim(isset($_POST['description'])   ? $_POST['description']   : '');
$prix          = floatval(isset($_POST['prix'])       ? $_POST['prix']         : 0);
$stock         = intval(isset($_POST['stock'])        ? $_POST['stock']        : 0);
$idmarque      = trim(isset($_POST['idmarque'])       ? $_POST['idmarque']     : '');
$idfournisseur = intval(isset($_POST['idfournisseur'])? $_POST['idfournisseur']: 0);
$dia_raw       = isset($_POST['diametre'])            ? $_POST['diametre']     : '';
$ray_raw       = isset($_POST['rayon_courbure'])      ? $_POST['rayon_courbure']: '';
$pmin_raw      = isset($_POST['puissance_min'])       ? $_POST['puissance_min']: '';
$pmax_raw      = isset($_POST['puissance_max'])       ? $_POST['puissance_max']: '';
$diametre       = ($dia_raw  !== '') ? floatval($dia_raw)  : null;
$rayon_courbure = ($ray_raw  !== '') ? floatval($ray_raw)  : null;
$puissance_min  = ($pmin_raw !== '') ? floatval($pmin_raw) : null;
$puissance_max  = ($pmax_raw !== '') ? floatval($pmax_raw) : null;
if ($type          === '') { $type          = null; }
if ($correction    === '') { $correction    = null; }
if ($idmarque      === '') { $idmarque      = null; }
if ($idfournisseur == 0)   { $idfournisseur = null; }
if (empty($idlentille) || empty($nom)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con,
    "INSERT INTO lentille (idlentille, nom, idmarque, type, materiau, correction, couleur,
     diametre, rayon_courbure, puissance_min, puissance_max, prix, stock, idfournisseur, description)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssssddddiis s",
    $idlentille, $nom, $idmarque, $type, $materiau, $correction, $couleur,
    $diametre, $rayon_courbure, $puissance_min, $puissance_max, $prix, $stock, $idfournisseur, $description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("lentille_list.php");
