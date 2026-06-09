<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = intval(isset($_GET['id']) ? $_GET['id'] : 0);
$res   = mysqli_query($con, "SELECT * FROM opticien WHERE idopticien=$id");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("opticien_list.php"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Opticien</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow col-md-9 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Opticien #<?php echo $dataS['idopticien']; ?></h4></div>
    <div class="card-body">
        <form method="post" action="opticien_update.php">
            <input type="hidden" name="idopticien" value="<?php echo $dataS['idopticien']; ?>">
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label fw-bold">ID (non modifiable)</label>
                    <input type="text" class="form-control bg-light" value="<?php echo $dataS['idopticien']; ?>" disabled></div>
                <div class="col-md-8"><label class="form-label fw-bold">Nom du magasin <span class="text-danger">*</span></label>
                    <input type="text" name="nommagasin" class="form-control" value="<?php echo htmlspecialchars($dataS['nommagasin']); ?>" required></div>
                <div class="col-md-6"><label class="form-label fw-bold">Responsable <span class="text-danger">*</span></label>
                    <input type="text" name="responsable" class="form-control" value="<?php echo htmlspecialchars($dataS['responsable']); ?>" required></div>
                <div class="col-md-6"><label class="form-label fw-bold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?php echo htmlspecialchars($dataS['telephone']); ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($dataS['email']); ?>"></div>
                <div class="col-md-6"><label class="form-label fw-bold">Licence <span class="text-danger">*</span></label>
                    <input type="text" name="license" class="form-control" value="<?php echo htmlspecialchars($dataS['license']); ?>" required></div>
                <div class="col-12"><label class="form-label fw-bold">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="<?php echo htmlspecialchars($dataS['adresse']); ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Ville</label>
                    <input type="text" name="ville" class="form-control" value="<?php echo htmlspecialchars($dataS['ville']); ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Pays</label>
                    <input type="text" name="pays" class="form-control" value="<?php echo htmlspecialchars($dataS['pays']); ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Date inscription</label>
                    <input type="date" name="dateinscription" class="form-control" value="<?php echo $dataS['dateinscription']; ?>"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Statut</label>
                    <select name="statut" class="form-select">
                        <?php foreach(array('actif','inactif','suspendu') as $st): ?>
                        <option value="<?php echo $st; ?>" <?php echo ($dataS['statut']==$st)?'selected':''; ?>><?php echo ucfirst($st); ?></option>
                        <?php endforeach; ?>
                    </select></div>
                <div class="col-md-8"><label class="form-label fw-bold">Nouveau mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control" placeholder="Laisser vide pour ne pas changer">
                    <small class="text-muted">Laissez vide pour conserver le mot de passe actuel.</small></div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="opticien_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
