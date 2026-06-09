<?php
require("../connexion.php");
$marques     = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
$fournisseurs= mysqli_query($con, "SELECT idfournisseur, nom FROM fournisseur ORDER BY nom");
$categories  = mysqli_query($con, "SELECT idcategorie, nomcategorie FROM categorie ORDER BY nomcategorie");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Ajouter Monture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-8 mx-auto">
    <div class="card-header bg-danger text-white">
        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter une Monture</h4>
    </div>
    <div class="card-body">
        <form method="post" action="monture_add.php">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Référence <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                        <input type="text" name="reference" class="form-control" placeholder="Ex: RB021" maxlength="50" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Modèle</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-eyeglasses"></i></span>
                        <input type="text" name="modele" class="form-control" placeholder="Ex: Aviator Classic">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Genre</label>
                    <select name="genre" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="enfant">Enfant</option>
                        <option value="mixte">Mixte</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Couleur</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-palette"></i></span>
                        <input type="text" name="couleur" class="form-control" placeholder="Ex: Noir, Doré…">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Matériau</label>
                    <select name="materiau" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="Acétate">Acétate</option>
                        <option value="Métal">Métal</option>
                        <option value="Titane">Titane</option>
                        <option value="Plastique">Plastique</option>
                        <option value="TR90">TR90</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Prix (MAD) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-currency-exchange"></i></span>
                        <input type="number" name="prix" class="form-control" step="0.01" min="0" placeholder="Ex: 1500.00" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Stock</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-boxes"></i></span>
                        <input type="number" name="stock" class="form-control" min="0" value="0">
                    </div>
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
                <div class="col-md-6">
                    <label class="form-label fw-bold">Catégorie</label>
                    <select name="idcategorie" class="form-select">
                        <option value="">-- Aucune --</option>
                        <?php while($c = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo htmlspecialchars($c['idcategorie']); ?>">
                            <?php echo htmlspecialchars($c['idcategorie'].' - '.$c['nomcategorie']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Description de la monture…"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="monture_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
<?php mysqli_close($con); ?>
