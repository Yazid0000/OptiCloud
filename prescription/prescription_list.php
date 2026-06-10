<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Prescriptions";
$page_breadcrumb = "Patients / <span>Prescriptions</span>";
$btn_action      = "Ajouter une prescription";
$btn_action_url  = "prescription/ajouter_form.php";

$liste = mysqli_query($con, "SELECT pr.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom,
    CONCAT(o.prenom_opticien,' ',o.nom_opticien) AS opticien_nom
    FROM prescription pr
    JOIN patient p ON p.id = pr.patient_id
    LEFT JOIN opticien o ON o.id = pr.opticien_id
    ORDER BY pr.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-file-medical me-2"></i>Liste des prescriptions</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>OD (sph / cyl / axe)</th>
                    <th>OG (sph / cyl / axe)</th>
                    <th>Addition</th>
                    <th>Opticien</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['patient_nom']); ?></td>
                <td><?php echo $row['date_prescription']; ?></td>
                <td><?php echo $row['od_sphere'].' / '.$row['od_cylindre'].' / '.$row['od_axe'].'°'; ?></td>
                <td><?php echo $row['og_sphere'].' / '.$row['og_cylindre'].' / '.$row['og_axe'].'°'; ?></td>
                <td><?php echo $row['addition']; ?></td>
                <td><?php echo htmlspecialchars($row['opticien_nom']); ?></td>
                <td>
                    <a href="<?php echo $base_url; ?>prescription/prescription_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="<?php echo $base_url; ?>prescription/prescription_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cette prescription ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="8" style="text-align:center; color:#475569; padding:20px;">Aucune prescription trouvée</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>