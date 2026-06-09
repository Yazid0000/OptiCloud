<?php
require("../auth.php");
require("../connexion.php");
$res    = mysqli_query($con, "SELECT * FROM opticien ORDER BY idopticien");
$nombre = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"><title>Liste des opticiens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-4 px-4">
<div class="card shadow">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-shop me-2"></i>Liste des opticiens</h4>
        <div>
            <a href="../index.php" class="btn btn-outline-light btn-sm me-1"><i class="bi bi-house"></i> Accueil</a>
            <a href="ajouter_form.php" class="btn btn-light btn-sm me-1"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <a href="opticien_print.php" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i> Imprimer</a>
        </div>
    </div>
    <div class="card-body">
        <p class="fw-bold">Nombre d'opticiens : <span class="badge bg-secondary"><?php echo $nombre; ?></span></p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle small">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th><th>Magasin</th><th>Responsable</th><th>Ville</th><th>Téléphone</th>
                        <th>Email</th><th>Licence</th><th>Inscription</th><th>Statut</th><th width="110">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($d = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td class="text-center fw-bold"><?php echo $d['idopticien']; ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($d['nommagasin']); ?></td>
                        <td><?php echo htmlspecialchars($d['responsable']); ?></td>
                        <td><?php echo htmlspecialchars($d['ville']); ?></td>
                        <td><?php echo htmlspecialchars($d['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($d['email']); ?></td>
                        <td><code><?php echo htmlspecialchars($d['license']); ?></code></td>
                        <td class="text-center"><?php echo $d['dateinscription'] ? date('d/m/Y', strtotime($d['dateinscription'])) : '—'; ?></td>
                        <td class="text-center">
                            <?php
                            $s = $d['statut'];
                            $sc = $s === 'actif' ? 'success' : ($s === 'inactif' ? 'danger' : 'warning');
                            echo '<span class="badge bg-'.$sc.'">'.ucfirst($s).'</span>';
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="opticien_modifier.php?id=<?php echo $d['idopticien']; ?>" class="btn btn-sm btn-success" title="Modifier"><i class="bi bi-pencil-square"></i></a>
                            <a href="opticien_confirm.php?id=<?php echo $d['idopticien']; ?>" class="btn btn-sm btn-danger" title="Supprimer"><i class="bi bi-trash"></i></a>
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
