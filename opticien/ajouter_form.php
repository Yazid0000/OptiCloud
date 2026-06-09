<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Ajouter Opticien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-9 mx-auto">
    <div class="card-header bg-secondary text-white">
        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajouter un Opticien</h4>
    </div>
    <div class="card-body">
        <form method="post" action="opticien_add.php">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">ID Opticien <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <input type="number" name="idopticien" class="form-control" placeholder="Ex: 11" min="1" required>
                    </div>
                    <small class="text-muted">Identifiant unique numérique</small>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Nom du magasin <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shop"></i></span>
                        <input type="text" name="nommagasin" class="form-control" placeholder="Ex: Optique Vision Plus" maxlength="150" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Responsable <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="responsable" class="form-control" placeholder="Nom complet" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="telephone" class="form-control" placeholder="0612345678">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="contact@exemple.ma">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Licence <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" name="license" class="form-control" placeholder="Ex: LIC-OPT-1011" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Adresse</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="adresse" class="form-control" placeholder="Rue, numéro…">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Ville</label>
                    <input type="text" name="ville" class="form-control" placeholder="Ex: Casablanca">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Pays</label>
                    <input type="text" name="pays" class="form-control" value="Maroc">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date d'inscription</label>
                    <input type="date" name="dateinscription" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="actif" selected>Actif</option>
                        <option value="inactif">Inactif</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="motdepasse" class="form-control" placeholder="Mot de passe">
                    </div>
                    <small class="text-muted">Laisser vide si non utilisé</small>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="opticien_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
