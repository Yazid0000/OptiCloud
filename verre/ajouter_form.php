<?php
require("../connexion.php");
// Charger les marques pour la liste déroulante
$marques = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ajouter Verre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow col-md-7 mx-auto">
        <div class="card-header text-white" style="background:#17a2b8;">
            <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter un Verre</h4>
        </div>
        <div class="card-body">
            <form method="post" action="verre_add.php">

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Verre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <!-- Colonne réelle : idverre (ex: ZE20) -->
                        <input type="text" name="idverre" class="form-control" placeholder="Ex: ZE20" maxlength="10" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" name="nom" class="form-control" placeholder="Ex: Zeiss Individual 2" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Type <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-layers"></i></span>
                        <!-- Colonne réelle : type (pas type_verre) -->
                        <select name="type" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="Simple">Simple</option>
                            <option value="Progressif">Progressif</option>
                            <option value="Bifocal">Bifocal</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Indice</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                        <select name="indice" class="form-select">
                            <option value="">-- Choisir --</option>
                            <option value="1.50">1.50</option>
                            <option value="1.60">1.60</option>
                            <option value="1.67">1.67</option>
                            <option value="1.74">1.74</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Traitement</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                        <input type="text" name="traitement" class="form-control" placeholder="Ex: Antireflet, Photochromique">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Prix (MAD) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-currency-exchange"></i></span>
                        <input type="number" name="prix" class="form-control" step="0.01" min="0" placeholder="Ex: 850.00" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Marque</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-award"></i></span>
                        <!-- Colonne réelle : idmarque (FK vers marque) -->
                        <select name="idmarque" class="form-select">
                            <option value="">-- Aucune --</option>
                            <?php while($m = mysqli_fetch_assoc($marques)): ?>
                            <option value="<?php echo htmlspecialchars($m['idmarque']); ?>">
                                <?php echo htmlspecialchars($m['idmarque'].' - '.$m['nom']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Description du verre…"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="verre_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php mysqli_close($con); ?>
