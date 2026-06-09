<?php
require("../auth.php");
require("../connexion.php");
require("../fonctions.php");
$id    = isset($_GET['id']) ? $_GET['id'] : '';
$id_esc= mysqli_real_escape_string($con, $id);
$res   = mysqli_query($con, "SELECT * FROM verre WHERE idverre='$id_esc'");
$dataS = mysqli_fetch_assoc($res);
if (!$dataS) { redirection("verre_list.php"); }
$marques = mysqli_query($con, "SELECT idmarque, nom FROM marque ORDER BY nom");
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Modifier Verre</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="card shadow col-md-7 mx-auto">
    <div class="card-header bg-warning text-dark"><h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier Verre</h4></div>
    <div class="card-body">
        <form method="post" action="verre_update.php">
            <input type="hidden" name="idverre" value="<?php echo htmlspecialchars($dataS['idverre']); ?>">
            <div class="mb-3"><label class="form-label fw-bold">ID (non modifiable)</label>
                <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($dataS['idverre']); ?>" disabled></div>
            <div class="mb-3"><label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($dataS['nom']); ?>" required></div>
            <div class="mb-3"><label class="form-label fw-bold">Type</label>
                <select name="type" class="form-select">
                    <?php foreach(array('Simple','Progressif','Bifocal') as $t): ?>
                    <option value="<?php echo $t; ?>" <?php echo ($dataS['type']==$t)?'selected':''; ?>><?php echo $t; ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-3"><label class="form-label fw-bold">Indice</label>
                <select name="indice" class="form-select">
                    <?php foreach(array('1.50','1.60','1.67','1.74') as $idx): ?>
                    <option value="<?php echo $idx; ?>" <?php echo ($dataS['indice']==$idx)?'selected':''; ?>><?php echo $idx; ?></option>
                    <?php endforeach; ?>
                </select></div>
            <div class="mb-3"><label class="form-label fw-bold">Traitement</label>
                <input type="text" name="traitement" class="form-control" value="<?php echo htmlspecialchars($dataS['traitement']); ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Prix (MAD)</label>
                <input type="number" name="prix" class="form-control" step="0.01" value="<?php echo $dataS['prix']; ?>"></div>
            <div class="mb-3"><label class="form-label fw-bold">Marque</label>
                <select name="idmarque" class="form-select">
                    <option value="">-- Aucune --</option>
                    <?php while($m = mysqli_fetch_assoc($marques)): ?>
                    <option value="<?php echo htmlspecialchars($m['idmarque']); ?>" <?php echo ($dataS['idmarque']==$m['idmarque'])?'selected':''; ?>>
                        <?php echo htmlspecialchars($m['idmarque'].' - '.$m['nom']); ?>
                    </option>
                    <?php endwhile; ?>
                </select></div>
            <div class="mb-3"><label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($dataS['description']); ?></textarea></div>
            <div class="d-flex justify-content-between">
                <a href="verre_list.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>
</body></html>
<?php mysqli_close($con); ?>
