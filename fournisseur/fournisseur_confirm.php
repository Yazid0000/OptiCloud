<?php
require("../connexion.php");
require("../fonctions.php");
$id    = intval(isset($_GET['id']) ? $_GET['id'] : 0);
$res   = mysqli_query($con, "SELECT * FROM fournisseur WHERE idfournisseur=$id");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("fournisseur_list.php"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Confirmer suppression</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-6 mx-auto border-danger">
    <div class="card-header bg-danger text-white"><h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmation de suppression</h4></div>
    <div class="card-body">
        <div class="alert alert-warning"><i class="bi bi-info-circle"></i> Vous allez supprimer ce fournisseur.</div>
        <p><strong>ID :</strong> <?php echo $dataS['idfournisseur']; ?></p>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($dataS['nom']); ?></p>
        <p><strong>Responsable :</strong> <?php echo htmlspecialchars($dataS['responsable']); ?></p>
        <p><strong>Ville :</strong> <?php echo htmlspecialchars($dataS['ville']); ?></p>
        <div class="d-flex justify-content-between mt-3">
            <a href="fournisseur_delete.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Oui, Supprimer</a>
            <a href="fournisseur_list.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Annuler</a>
        </div>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
