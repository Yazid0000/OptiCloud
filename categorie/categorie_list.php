<?php
require("../auth.php");
require("../connexion.php");
// Correction : les colonnes SQL sont idcategorie et nomcategorie (sans underscore)
$r = "SELECT * FROM categorie ORDER BY idcategorie";
$res = mysqli_query($con, $r);
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Liste des catégories</h4>
            <div>
                <a href="../index.php" class="btn btn-outline-light btn-sm me-1">
                    <i class="bi bi-house"></i> Accueil
                </a>
                <a href="ajouter_form.php" class="btn btn-light btn-sm me-1">
                    <i class="bi bi-plus-circle"></i> Ajouter
                </a>
                <a href="categorie_print.php" class="btn btn-warning btn-sm">
                    <i class="bi bi-printer"></i> Imprimer
                </a>
            </div>
        </div>
        <div class="card-body">
            <p class="fw-bold">
                Nombre de catégories :
                <span class="badge bg-secondary"><?php echo $nombre; ?></span>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID Catégorie</th>
                            <th>Nom Catégorie</th>
                            <th width="130">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($dataS = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <!-- Correction : idcategorie (sans underscore) -->
                                <td class="text-center fw-bold"><?php echo htmlspecialchars($dataS['idcategorie']); ?></td>
                                <td><?php echo htmlspecialchars($dataS['nomcategorie']); ?></td>
                                <td class="text-center">
                                    <a href="categorie_modifier.php?id=<?php echo urlencode($dataS['idcategorie']); ?>"
                                       class="btn btn-sm btn-success" title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="categorie_confirm.php?id=<?php echo urlencode($dataS['idcategorie']); ?>"
                                       class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php mysqli_close($con); ?>
