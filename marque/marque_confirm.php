<?php
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
<head><meta charset="utf-8"><title>Confirmer suppression</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-6 mx-auto border-danger">
    <div class="card-header bg-danger text-white"><h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmation de suppression</h4></div>
    <div class="card-body">
        <div class="alert alert-warning"><i class="bi bi-info-circle"></i> Attention : supprimer cette marque peut affecter les produits liés.</div>
        <p><strong>ID :</strong> <code><?php echo htmlspecialchars($dataS['idmarque']); ?></code></p>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($dataS['nom']); ?></p>
        <p><strong>Pays :</strong> <?php echo htmlspecialchars($dataS['pays']); ?></p>
        <div class="d-flex justify-content-between mt-3">
            <a href="marque_delete.php?id=<?php echo urlencode($id); ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Oui, Supprimer</a>
            <a href="marque_list.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Annuler</a>
        </div>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
