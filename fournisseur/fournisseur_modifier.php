<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = intval(isset($_GET['id']) ? $_GET['id'] : 0);
$res   = mysqli_query($con, "SELECT * FROM fournisseur WHERE idfournisseur=$id");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("fournisseur_list.php"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Fournisseur</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-7 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Fournisseur</h4></div>
    <div class="card-body">
        <form method="post" action="fournisseur_update.php">
            <input type="hidden" name="idfournisseur" value="<?php echo $dataS['idfournisseur']; ?>">
            <div class="mb-3"><label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($dataS['nom']); ?>" required></div>
            <div class="mb-3"><label class="form-label fw-bold">Responsable <span class="text-danger">*</span></label>
                <input type="text" name="responsable" class="form-control" value="<?php echo htmlspecialchars($dataS['responsable']); ?>" required></div>
            <div class="mb-3"><label class="form-label fw-bold">Adresse</label>
                <input type="text" name="adresse" class="form-control" value="<?php echo htmlspecialchars($dataS['adresse']); ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Ville</label>
                <input type="text" name="ville" class="form-control" value="<?php echo htmlspecialchars($dataS['ville']); ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="<?php echo htmlspecialchars($dataS['telephone']); ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($dataS['email']); ?>"></div>
            <div class="d-flex justify-content-between">
                <a href="fournisseur_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
