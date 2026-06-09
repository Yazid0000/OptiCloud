<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = isset($_GET['id']) ? $_GET['id'] : '';
$id_esc= mysqli_real_escape_string($con, $id);
$res   = mysqli_query($con, "SELECT * FROM marque WHERE idmarque='$id_esc'");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("marque_list.php"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Marque</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-7 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Marque</h4></div>
    <div class="card-body">
        <form method="post" action="marque_update.php">
            <input type="hidden" name="idmarque" value="<?php echo htmlspecialchars($dataS['idmarque']); ?>">
            <div class="mb-3"><label class="form-label fw-bold">ID (non modifiable)</label>
                <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($dataS['idmarque']); ?>" disabled></div>
            <div class="mb-3"><label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($dataS['nom']); ?>" required></div>
            <div class="mb-3"><label class="form-label fw-bold">Pays</label>
                <input type="text" name="pays" class="form-control" value="<?php echo htmlspecialchars($dataS['pays']); ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($dataS['description']); ?></textarea></div>
            <div class="d-flex justify-content-between">
                <a href="marque_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
