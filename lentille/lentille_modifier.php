<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = isset($_GET['id']) ? $_GET['id'] : '';
$id_esc= mysqli_real_escape_string($con, $id);
$res   = mysqli_query($con, "SELECT * FROM lentille WHERE idlentille='$id_esc'");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("lentille_list.php"); }
$marques      = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
$fournisseurs = mysqli_query($con, "SELECT idfournisseur, nom FROM fournisseur ORDER BY nom");
$types       = array('journaliere','hebdomadaire','mensuelle','annuelle');
$corrections = array('spherique','torique','multifocale');
$materiaux   = array('Silicone-hydrogel','Hydrogel','PMMA','Rigide permeable aux gaz');
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Lentille</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-9 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Lentille — <?php echo htmlspecialchars($dataS['idlentille']); ?></h4></div>
    <div class="card-body">
        <form method="post" action="lentille_update.php">
            <input type="hidden" name="idlentille" value="<?php echo htmlspecialchars($dataS['idlentille']); ?>">
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label fw-bold">ID (non modifiable)</label>
                    <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($dataS['idlentille']); ?>" disabled></div>
                <div class="col-md-8"><label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($dataS['nom']); ?>" required></div>
                <div class="col-md-4"><label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <?php foreach($types as $t): ?>
                        <option value="<?php echo $t; ?>" <?php echo ($dataS['type']==$t)?'selected':''; ?>><?php echo ucfirst($t); ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-4"><label class="form-label fw-bold">Correction</label>
                    <select name="correction" class="form-select">
                        <?php foreach($corrections as $c): ?>
                        <option value="<?php echo $c; ?>" <?php echo ($dataS['correction']==$c)?'selected':''; ?>><?php echo ucfirst($c); ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-4"><label class="form-label fw-bold">Matériau</label>
                    <select name="materiau" class="form-select">
                        <?php foreach($materiaux as $mat): ?>
                        <option value="<?php echo $mat; ?>" <?php echo ($dataS['materiau']==$mat)?'selected':''; ?>><?php echo $mat; ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-4"><label class="form-label fw-bold">Couleur</label>
                    <input type="text" name="couleur" class="form-control" value="<?php echo htmlspecialchars($dataS['couleur']); ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Diametre (mm)</label>
                    <input type="number" name="diametre" class="form-control" step="0.1" value="<?php echo $dataS['diametre']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Rayon courbure (mm)</label>
                    <input type="number" name="rayon_courbure" class="form-control" step="0.01" value="<?php echo $dataS['rayon_courbure']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Puissance min</label>
                    <input type="number" name="puissance_min" class="form-control" step="0.01" value="<?php echo $dataS['puissance_min']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Puissance max</label>
                    <input type="number" name="puissance_max" class="form-control" step="0.01" value="<?php echo $dataS['puissance_max']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Prix (MAD)</label>
                    <input type="number" name="prix" class="form-control" step="0.01" value="<?php echo $dataS['prix']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Stock</label>
                    <input type="number" name="stock" class="form-control" min="0" value="<?php echo $dataS['stock']; ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Marque</label>
                    <select name="idmarque" class="form-select">
                        <option value="">-- Aucune --</option>
                        <?php while($m = mysqli_fetch_assoc($marques)): ?>
                        <option value="<?php echo htmlspecialchars($m['idmarque']); ?>" <?php echo ($dataS['idmarque']==$m['idmarque'])?'selected':''; ?>>
                            <?php echo htmlspecialchars($m['idmarque'].' - '.$m['nom']); ?></option>
                        <?php endwhile; ?>
                    </select></div>
                <div class="col-md-6"><label class="form-label fw-bold">Fournisseur</label>
                    <select name="idfournisseur" class="form-select">
                        <option value="">-- Aucun --</option>
                        <?php while($f = mysqli_fetch_assoc($fournisseurs)): ?>
                        <option value="<?php echo $f['idfournisseur']; ?>" <?php echo ($dataS['idfournisseur']==$f['idfournisseur'])?'selected':''; ?>>
                            <?php echo htmlspecialchars($f['idfournisseur'].' - '.$f['nom']); ?></option>
                        <?php endwhile; ?>
                    </select></div>
                <div class="col-12"><label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($dataS['description']); ?></textarea></div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="lentille_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
