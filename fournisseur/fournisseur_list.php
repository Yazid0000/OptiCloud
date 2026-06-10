<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Fournisseurs";
$page_breadcrumb = "Fournisseurs / <span>Liste</span>";
$btn_action      = "Ajouter un fournisseur";
$btn_action_url  = "fournisseur/ajouter_form.php";

$liste = mysqli_query($con, "SELECT * FROM fournisseur ORDER BY id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-truck me-2"></i>Liste des fournisseurs</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['nom_fournisseur']); ?></td>
                <td><?php echo htmlspecialchars($row['tel_fournisseur']); ?></td>
                <td><?php echo htmlspecialchars($row['email_fournisseur']); ?></td>
                <td><?php echo htmlspecialchars($row['ville_fournisseur']); ?></td>
                <td>
                    <a href="fournisseur_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="fournisseur_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer ce fournisseur ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" style="text-align:center; color:#475569; padding:20px;">Aucun fournisseur trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>