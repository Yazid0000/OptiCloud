<?php
require("../auth.php");
require("../connexion.php");
$r = "SELECT mo.*, ma.nom AS nommarque, f.nom AS nomfournisseur, c.nomcategorie
      FROM monture mo
      LEFT JOIN marque ma ON mo.idmarque=ma.idmarque
      LEFT JOIN fournisseur f ON mo.idfournisseur=f.idfournisseur
      LEFT JOIN categorie c ON mo.idcategorie=c.idcategorie
      ORDER BY mo.idmonture";
$res    = mysqli_query($con, $r);
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Liste des montures</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-4 px-4">
<div class="card shadow">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-eyeglasses me-2"></i>Liste des montures</h4>
        <div>
            <a href="../index.php" class="btn btn-outline-light btn-sm me-1"><i class="bi bi-house"></i> Accueil</a>
            <a href="ajouter_form.php" class="btn btn-light btn-sm me-1"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <a href="monture_print.php" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i> Imprimer</a>
        </div>
    </div>
    <div class="card-body">
        <p class="fw-bold">Nombre de montures : <span class="badge bg-secondary"><?php echo $nombre; ?></span></p>
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle small">
            <thead class="table-dark text-center">
                <tr><th>ID</th><th>Ref</th><th>Modele</th><th>Genre</th><th>Couleur</th><th>Materiau</th><th>Prix MAD</th><th>Stock</th><th>Marque</th><th>Fournisseur</th><th>Categorie</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php while ($d = mysqli_fetch_assoc($res)) {
                $genre = $d['genre'];
                $badgeColor = array('homme'=>'primary','femme'=>'danger','enfant'=>'success','mixte'=>'secondary');
                $bc = isset($badgeColor[$genre]) ? $badgeColor[$genre] : 'dark';
                $stock = $d['stock'];
                $sc = ($stock <= 3) ? 'badge bg-danger' : (($stock <= 10) ? 'badge bg-warning text-dark' : 'badge bg-success');
                $nommarque     = isset($d['nommarque'])     ? $d['nommarque']     : $d['idmarque'];
                $nomfournisseur= isset($d['nomfournisseur'])? $d['nomfournisseur']: '-';
                $nomcategorie  = isset($d['nomcategorie'])  ? $d['nomcategorie']  : '-';
            ?>
            <tr>
                <td class="text-center fw-bold"><?php echo $d['idmonture']; ?></td>
                <td><?php echo htmlspecialchars($d['reference']); ?></td>
                <td><?php echo htmlspecialchars($d['modele']); ?></td>
                <td><span class="badge bg-<?php echo $bc; ?>"><?php echo ucfirst($genre); ?></span></td>
                <td><?php echo htmlspecialchars($d['couleur']); ?></td>
                <td><?php echo htmlspecialchars($d['materiau']); ?></td>
                <td class="text-end fw-bold"><?php echo number_format($d['prix'],2,',',' '); ?></td>
                <td class="text-center"><span class="<?php echo $sc; ?>"><?php echo $stock; ?></span></td>
                <td><?php echo htmlspecialchars($nommarque); ?></td>
                <td><?php echo htmlspecialchars($nomfournisseur); ?></td>
                <td><?php echo htmlspecialchars($nomcategorie); ?></td>
                <td class="text-center">
                    <a href="monture_modifier.php?id=<?php echo $d['idmonture']; ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                    <a href="monture_confirm.php?id=<?php echo $d['idmonture']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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
