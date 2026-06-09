<?php
require("../auth.php");
require("../connexion.php");
$r = "SELECT v.*, m.nom AS nommarque FROM verre v LEFT JOIN marque m ON v.idmarque=m.idmarque ORDER BY v.idverre";
$res    = mysqli_query($con, $r);
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Liste des verres</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-4 px-4">
<div class="card shadow">
    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background:#17a2b8;">
        <h4 class="mb-0"><i class="bi bi-circle-half me-2"></i>Liste des verres</h4>
        <div>
            <a href="../index.php" class="btn btn-outline-light btn-sm me-1"><i class="bi bi-house"></i> Accueil</a>
            <a href="ajouter_form.php" class="btn btn-light btn-sm me-1"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <a href="verre_print.php" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i> Imprimer</a>
        </div>
    </div>
    <div class="card-body">
        <p class="fw-bold">Nombre de verres : <span class="badge bg-secondary"><?php echo $nombre; ?></span></p>
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark text-center">
                <tr><th>ID</th><th>Nom</th><th>Type</th><th>Indice</th><th>Traitement</th><th>Prix MAD</th><th>Marque</th><th>Description</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php while ($d = mysqli_fetch_assoc($res)) {
                $nommarque = isset($d['nommarque']) ? $d['nommarque'] : $d['idmarque'];
            ?>
            <tr>
                <td class="text-center fw-bold"><?php echo htmlspecialchars($d['idverre']); ?></td>
                <td><?php echo htmlspecialchars($d['nom']); ?></td>
                <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($d['type']); ?></span></td>
                <td class="text-center"><?php echo htmlspecialchars($d['indice']); ?></td>
                <td><?php echo htmlspecialchars($d['traitement']); ?></td>
                <td class="text-end fw-bold"><?php echo number_format($d['prix'],2,',',' '); ?></td>
                <td><?php echo htmlspecialchars($nommarque); ?></td>
                <td class="text-muted small"><?php echo htmlspecialchars($d['description']); ?></td>
                <td class="text-center">
                    <a href="verre_modifier.php?id=<?php echo urlencode($d['idverre']); ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                    <a href="verre_confirm.php?id=<?php echo urlencode($d['idverre']); ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
