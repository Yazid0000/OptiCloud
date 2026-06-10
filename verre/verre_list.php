<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Verres";
$page_breadcrumb = "Stock / <span>Verres</span>";
$btn_action      = "Ajouter un verre";
$btn_action_url  = "verre/ajouter_form.php";

$liste = mysqli_query($con, "SELECT v.*, c.nom_categorie, m.nom_marque
    FROM verre v
    LEFT JOIN categorie c ON c.id = v.id_categorie
    LEFT JOIN marque m ON m.id = v.id_marque
    ORDER BY v.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-circle-half me-2"></i>Liste des verres</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['ref_verre']); ?></td>
                <td><?php echo htmlspecialchars($row['nom_categorie']); ?></td>
                <td><?php echo htmlspecialchars($row['nom_marque']); ?></td>
                <td><?php echo number_format($row['prix_verre'], 2); ?> DH</td>
                <td>
                    <?php if ($row['stock'] < 5): ?>
                        <span class="badge-orange"><i class="bi bi-exclamation-triangle me-1"></i><?php echo $row['stock']; ?></span>
                    <?php else: ?>
                        <span class="badge-green"><?php echo $row['stock']; ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="verre_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="verre_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer ce verre ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="7" style="text-align:center; color:#475569; padding:20px;">Aucun verre trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>