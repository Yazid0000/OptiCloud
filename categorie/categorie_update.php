<?php
require("../connexion.php");
require("../fonctions.php");
$id_original  = trim(isset($_POST['id_original'])  ? $_POST['id_original']  : '');
$nomcategorie = trim(isset($_POST['nomcategorie']) ? $_POST['nomcategorie'] : '');
if (empty($id_original) || empty($nomcategorie)) { redirection("categorie_list.php"); }
$stmt = mysqli_prepare($con, "UPDATE categorie SET nomcategorie = ? WHERE idcategorie = ?");
mysqli_stmt_bind_param($stmt, "ss", $nomcategorie, $id_original);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("categorie_list.php");
