<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Marques";
$page_breadcrumb = "Stock / <span>Marques</span>";
$btn_action      = "Ajouter une marque";
$btn_action_url  = "marque/ajouter_form.php";

$liste = mysqli_query($con, "SELECT * FROM marque ORDER BY id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-bookmark me-2"></i>Liste des marques</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['nom_marque']); ?></td>
                <td>
                    <a href="marque_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="marque_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cette marque ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="3" style="text-align:center; color:#475569; padding:20px;">Aucune marque trouvée</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>