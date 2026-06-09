<?php
require("../connexion.php");
$marques      = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
$fournisseurs = mysqli_query($con, "SELECT idfournisseur, nom FROM fournisseur ORDER BY nom");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Ajouter Lentille</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-9 mx-auto">
    <div class="card-header text-white" style="background:#6f42c1;">
        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter une Lentille</h4>
    </div>
    <div class="card-body">
        <form method="post" action="lentille_add.php">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">ID Lentille <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <input type="text" name="idlentille" class="form-control" placeholder="Ex: LT006" maxlength="10" required>
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" name="nom" class="form-control" placeholder="Ex: Acuvue Moist" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="journalière">Journalière</option>
                        <option value="hebdomadaire">Hebdomadaire</option>
                        <option value="mensuelle">Mensuelle</option>
                        <option value="annuelle">Annuelle</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Correction</label>
                    <select name="correction" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="sphérique">Sphérique</option>
                        <option value="torique">Torique</option>
                        <option value="multifocale">Multifocale</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Matériau</label>
                    <select name="materiau" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="Silicone-hydrogel">Silicone-hydrogel</option>
                        <option value="Hydrogel">Hydrogel</option>
                        <option value="PMMA">PMMA</option>
                        <option value="Rigide">Rigide perméable aux gaz</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Couleur</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-palette"></i></span>
                        <input type="text" name="couleur" class="form-control" placeholder="Ex: transparent, bleu">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Diamètre (mm)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-circle"></i></span>
                        <input type="number" name="diametre" class="form-control" step="0.1" min="0" placeholder="Ex: 14.0">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Rayon de courbure (mm)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-arrow-left-right"></i></span>
                        <input type="number" name="rayon_courbure" class="form-control" step="0.01" placeholder="Ex: 8.40">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Puissance min</label>
                    <input type="number" name="puissance_min" class="form-control" step="0.01" placeholder="Ex: -6.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Puissance max</label>
                    <input type="number" name="puissance_max" class="form-control" step="0.01" placeholder="Ex: +4.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Prix (MAD) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-currency-exchange"></i></span>
                        <input type="number" name="prix" class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Stock</label>
                    <input type="number" name="stock" class="form-control" min="0" value="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Marque</label>
                    <select name="idmarque" class="form-select">
                        <option value="">-- Aucune --</option>
                        <?php while($m = mysqli_fetch_assoc($marques)): ?>
                        <option value="<?php echo htmlspecialchars($m['idmarque']); ?>">
                            <?php echo htmlspecialchars($m['idmarque'].' - '.$m['nom']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Fournisseur</label>
                    <select name="idfournisseur" class="form-select">
                        <option value="">-- Aucun --</option>
                        <?php while($f = mysqli_fetch_assoc($fournisseurs)): ?>
                        <option value="<?php echo $f['idfournisseur']; ?>">
                            <?php echo htmlspecialchars($f['idfournisseur'].' - '.$f['nom']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Description…"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="lentille_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
<?php mysqli_close($con); ?>
