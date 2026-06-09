<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = intval(isset($_GET['id']) ? $_GET['id'] : 0);
$res   = mysqli_query($con, "SELECT * FROM monture WHERE idmonture=$id");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("monture_list.php"); }
$marques      = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
$fournisseurs = mysqli_query($con, "SELECT idfournisseur, nom FROM fournisseur ORDER BY nom");
$categories   = mysqli_query($con, "SELECT idcategorie, nomcategorie FROM categorie ORDER BY nomcategorie");
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Monture</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Monture #<?php echo $dataS['idmonture']; ?></h4></div>
    <div class="card-body">
        <form method="post" action="monture_update.php">
            <input type="hidden" name="idmonture" value="<?php echo $dataS['idmonture']; ?>">
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label fw-bold">Référence <span class="text-danger">*</span></label>
                    <input type="text" name="reference" class="form-control" value="<?php echo htmlspecialchars($dataS['reference']); ?>" required></div>
                <div class="col-md-6"><label class="form-label fw-bold">Modèle</label>
                    <input type="text" name="modele" class="form-control" value="<?php echo htmlspecialchars($dataS['modele']); ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Genre</label>
                    <select name="genre" class="form-select">
                        <?php foreach(array('homme','femme','enfant','mixte') as $g): ?>
                        <option value="<?php echo $g; ?>" <?php echo ($dataS['genre']==$g)?'selected':''; ?>><?php echo ucfirst($g); ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-6"><label class="form-label fw-bold">Couleur</label>
                    <input type="text" name="couleur" class="form-control" value="<?php echo htmlspecialchars($dataS['couleur']); ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Matériau</label>
                    <select name="materiau" class="form-select">
                        <?php foreach(array('Acetate','Metal','Titane','Plastique','TR90') as $mat): ?>
                        <option value="<?php echo $mat; ?>" <?php echo ($dataS['materiau']==$mat)?'selected':''; ?>><?php echo $mat; ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-6"><label class="form-label fw-bold">Prix (MAD)</label>
                    <input type="number" name="prix" class="form-control" step="0.01" value="<?php echo $dataS['prix']; ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Stock</label>
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
                <div class="col-md-6"><label class="form-label fw-bold">Catégorie</label>
                    <select name="idcategorie" class="form-select">
                        <option value="">-- Aucune --</option>
                        <?php while($c = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo htmlspecialchars($c['idcategorie']); ?>" <?php echo ($dataS['idcategorie']==$c['idcategorie'])?'selected':''; ?>>
                            <?php echo htmlspecialchars($c['idcategorie'].' - '.$c['nomcategorie']); ?></option>
                        <?php endwhile; ?>
                    </select></div>
                <div class="col-12"><label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($dataS['description']); ?></textarea></div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="monture_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
