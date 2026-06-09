<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ajouter Fournisseur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow col-md-7 mx-auto">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter un Fournisseur</h4>
        </div>
        <div class="card-body">
            <!-- L'ID est AUTO_INCREMENT, il n'est pas saisi manuellement -->
            <form method="post" action="fournisseur_add.php">

                <div class="mb-3">
                    <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                        <input type="text" name="nom" class="form-control" placeholder="Nom du fournisseur" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Responsable <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="responsable" class="form-control" placeholder="Nom du responsable" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Adresse</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="adresse" class="form-control" placeholder="Adresse complète">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ville</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pin-map"></i></span>
                        <input type="text" name="ville" class="form-control" placeholder="Ville">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="telephone" class="form-control" placeholder="0522xxxxxx">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="contact@exemple.ma">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="fournisseur_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
