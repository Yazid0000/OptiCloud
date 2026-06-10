<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Lentilles";
$page_breadcrumb = "Stock / <span>Lentilles</span>";
$btn_action      = "Ajouter une lentille";
$btn_action_url  = "lentille/ajouter_form.php";

$liste = mysqli_query($con, "SELECT l.*, c.nom_categorie, m.nom_marque
    FROM lentille l
    LEFT JOIN categorie c ON c.id = l.id_categorie
    LEFT JOIN marque m ON m.id = l.id_marque
    ORDER BY l.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-bullseye me-2"></i>Liste des lentilles</div>
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
                <td class="primary-col"><?php echo htmlspecialchars($row['ref_lentille']); ?></td>
                <td><?php echo htmlspecialchars($row['nom_categorie']); ?></td>
                <td><?php echo htmlspecialchars($row['nom_marque']); ?></td>
                <td><?php echo number_format($row['prix_lentille'], 2); ?> DH</td>
                <td>
                    <?php if ($row['stock'] < 5): ?>
                        <span class="badge-orange"><i class="bi bi-exclamation-triangle me-1"></i><?php echo $row['stock']; ?></span>
                    <?php else: ?>
                        <span class="badge-green"><?php echo $row['stock']; ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="lentille_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="lentille_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cette lentille ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="7" style="text-align:center; color:#475569; padding:20px;">Aucune lentille trouvée</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>