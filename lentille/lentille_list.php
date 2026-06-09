<?php
require("../auth.php");
require("../connexion.php");
$r = "SELECT l.*, m.nom AS nommarque, f.nom AS nomfournisseur
      FROM lentille l
      LEFT JOIN marque m ON l.idmarque=m.idmarque
      LEFT JOIN fournisseur f ON l.idfournisseur=f.idfournisseur
      ORDER BY l.idlentille";
$res    = mysqli_query($con, $r);
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Liste des lentilles</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-4 px-4">
<div class="card shadow">
    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background:#6f42c1;">
        <h4 class="mb-0"><i class="bi bi-bullseye me-2"></i>Liste des lentilles</h4>
        <div>
            <a href="../index.php" class="btn btn-outline-light btn-sm me-1"><i class="bi bi-house"></i> Accueil</a>
            <a href="ajouter_form.php" class="btn btn-light btn-sm me-1"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <a href="lentille_print.php" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i> Imprimer</a>
        </div>
    </div>
    <div class="card-body">
        <p class="fw-bold">Nombre de lentilles : <span class="badge bg-secondary"><?php echo $nombre; ?></span></p>
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle small">
            <thead class="table-dark text-center">
                <tr><th>ID</th><th>Nom</th><th>Type</th><th>Correction</th><th>Materiau</th><th>Couleur</th><th>Prix MAD</th><th>Stock</th><th>Marque</th><th>Fournisseur</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php while ($d = mysqli_fetch_assoc($res)) {
                $typeColors = array('journaliere'=>'success','hebdomadaire'=>'info','mensuelle'=>'primary','annuelle'=>'warning');
                $t  = $d['type'];
                $tc = isset($typeColors[$t]) ? $typeColors[$t] : 'secondary';
                $stock = $d['stock'];
                $sc = ($stock <= 5) ? 'badge bg-danger' : (($stock <= 20) ? 'badge bg-warning text-dark' : 'badge bg-success');
                $nommarque      = isset($d['nommarque'])      ? $d['nommarque']      : $d['idmarque'];
                $nomfournisseur = isset($d['nomfournisseur']) ? $d['nomfournisseur'] : '-';
            ?>
            <tr>
                <td class="text-center fw-bold"><?php echo htmlspecialchars($d['idlentille']); ?></td>
                <td><?php echo htmlspecialchars($d['nom']); ?></td>
                <td><span class="badge bg-<?php echo $tc; ?>"><?php echo $t; ?></span></td>
                <td><?php echo htmlspecialchars($d['correction']); ?></td>
                <td><?php echo htmlspecialchars($d['materiau']); ?></td>
                <td><?php echo htmlspecialchars($d['couleur']); ?></td>
                <td class="text-end fw-bold"><?php echo number_format($d['prix'],2,',',' '); ?></td>
                <td class="text-center"><span class="<?php echo $sc; ?>"><?php echo $stock; ?></span></td>
                <td><?php echo htmlspecialchars($nommarque); ?></td>
                <td><?php echo htmlspecialchars($nomfournisseur); ?></td>
                <td class="text-center">
                    <a href="lentille_modifier.php?id=<?php echo urlencode($d['idlentille']); ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                    <a href="lentille_confirm.php?id=<?php echo urlencode($d['idlentille']); ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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
