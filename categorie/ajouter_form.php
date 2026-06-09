<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ajouter Catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow col-md-6 mx-auto">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter une Catégorie</h4>
        </div>
        <div class="card-body">
            <form method="post" action="categorie_add.php">

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Catégorie <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <input type="text" name="idcategorie" class="form-control"
                               placeholder="Ex: CAT09" maxlength="10" required>
                    </div>
                    <small class="text-muted">Maximum 10 caractères (ex: CAT09)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nom Catégorie <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" name="nomcategorie" class="form-control"
                               placeholder="Ex: Lunettes de vue" maxlength="100" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="categorie_list.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
