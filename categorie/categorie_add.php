<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$idcategorie  = trim(isset($_POST['idcategorie'])  ? $_POST['idcategorie']  : '');
$nomcategorie = trim(isset($_POST['nomcategorie']) ? $_POST['nomcategorie'] : '');
if (empty($idcategorie) || empty($nomcategorie)) { redirection("ajouter_form.php"); }
$stmt = mysqli_prepare($con, "INSERT INTO categorie (idcategorie, nomcategorie) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $idcategorie, $nomcategorie);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("categorie_list.php");
