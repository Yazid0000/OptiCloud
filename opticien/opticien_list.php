<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Opticiens";
$page_breadcrumb = "Administration / <span>Opticiens</span>";
$btn_action      = "Ajouter un opticien";
$btn_action_url  = "opticien/ajouter_form.php";

$liste = mysqli_query($con, "SELECT * FROM opticien ORDER BY id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-person-badge me-2"></i>Liste des opticiens</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['nom_opticien']); ?></td>
                <td><?php echo htmlspecialchars($row['prenom_opticien']); ?></td>
                <td><?php echo htmlspecialchars($row['tel_opticien']); ?></td>
                <td><?php echo htmlspecialchars($row['email_opticien']); ?></td>
                <td>
                    <a href="opticien_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="opticien_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cet opticien ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" style="text-align:center; color:#475569; padding:20px;">Aucun opticien trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>