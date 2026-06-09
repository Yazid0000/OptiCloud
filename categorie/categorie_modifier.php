<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';
// Compatible PHP 5 sans mysqlnd : on échappe manuellement et on utilise mysqli_query
$id_esc = mysqli_real_escape_string($con, $id);
$res   = mysqli_query($con, "SELECT * FROM categorie WHERE idcategorie='$id_esc'");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("categorie_list.php"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Catégorie</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Catégorie</h4></div>
    <div class="card-body">
        <form method="post" action="categorie_update.php">
            <input type="hidden" name="id_original" value="<?php echo htmlspecialchars($dataS['idcategorie']); ?>">
            <div class="mb-3"><label class="form-label fw-bold">ID Catégorie</label>
                <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($dataS['idcategorie']); ?>" disabled></div>
            <div class="mb-3"><label class="form-label fw-bold">Nom Catégorie <span class="text-danger">*</span></label>
                <input type="text" name="nomcategorie" class="form-control" value="<?php echo htmlspecialchars($dataS['nomcategorie']); ?>" required></div>
            <div class="d-flex justify-content-between">
                <a href="categorie_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
