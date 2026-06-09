<?php
require("../auth.php");
require("../connexion.php");
$res    = mysqli_query($con, "SELECT * FROM marque ORDER BY nom");
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Liste des marques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-4 px-4">
<div class="card shadow">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-award-fill me-2"></i>Liste des marques</h4>
        <div>
            <a href="../index.php" class="btn btn-outline-dark btn-sm me-1"><i class="bi bi-house"></i> Accueil</a>
            <a href="ajouter_form.php" class="btn btn-dark btn-sm me-1"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <a href="marque_print.php" class="btn btn-secondary btn-sm"><i class="bi bi-printer"></i> Imprimer</a>
        </div>
    </div>
    <div class="card-body">
        <p class="fw-bold">Nombre de marques : <span class="badge bg-secondary"><?php echo $nombre; ?></span></p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th><th>Nom</th><th>Pays</th><th>Description</th><th width="110">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($d = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td class="text-center fw-bold"><code><?php echo htmlspecialchars($d['idmarque']); ?></code></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($d['nom']); ?></td>
                        <td><?php echo htmlspecialchars($d['pays']); ?></td>
                        <td class="text-muted small"><?php echo htmlspecialchars($d['description']); ?></td>
                        <td class="text-center">
                            <a href="marque_modifier.php?id=<?php echo urlencode($d['idmarque']); ?>" class="btn btn-sm btn-success" title="Modifier"><i class="bi bi-pencil-square"></i></a>
                            <a href="marque_confirm.php?id=<?php echo urlencode($d['idmarque']); ?>" class="btn btn-sm btn-danger" title="Supprimer"><i class="bi bi-trash"></i></a>
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
