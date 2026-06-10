<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Patients";
$page_breadcrumb = "Patients / <span>Liste</span>";
$btn_action      = "Ajouter un patient";
$btn_action_url  = "patient/ajouter_form.php";

$liste = mysqli_query($con, "SELECT * FROM patient ORDER BY id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-people me-2"></i>Liste des patients</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom complet</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Mutuelle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['prenom'].' '.$row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['mutuelle']); ?></td>
                <td>
                    <a href="<?php echo $base_url; ?>patient/patient_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="<?php echo $base_url; ?>patient/patient_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer ce patient ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" style="text-align:center; color:#475569; padding:20px;">Aucun patient trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>