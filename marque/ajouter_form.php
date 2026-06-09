<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Ajouter Marque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-7 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter une Marque</h4>
    </div>
    <div class="card-body">
        <form method="post" action="marque_add.php">
            <div class="mb-3">
                <label class="form-label fw-bold">ID Marque <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-hash"></i></span>
                    <input type="text" name="idmarque" class="form-control" placeholder="Ex: PO (2-5 caractères)" maxlength="5" required>
                </div>
                <small class="text-muted">Code court unique, ex: RB pour Ray-Ban</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-award"></i></span>
                    <input type="text" name="nom" class="form-control" placeholder="Ex: Ray-Ban" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Pays</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-globe"></i></span>
                    <input type="text" name="pays" class="form-control" placeholder="Ex: Italie">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="2" placeholder="Description de la marque…"></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="marque_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
