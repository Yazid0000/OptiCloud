<?php
require("../connexion.php");
require("../fonctions.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$stmt = mysqli_prepare($con, "DELETE FROM marque WHERE idmarque = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
redirection("marque_list.php");
