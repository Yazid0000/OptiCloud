<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Commandes fournisseurs";
$page_breadcrumb = "Fournisseurs / <span>Commandes</span>";
$btn_action      = "Nouvelle commande";
$btn_action_url  = "commande/ajouter_form.php";

$liste = mysqli_query($con, "SELECT c.*, f.nom_fournisseur
    FROM commande c
    JOIN fournisseur f ON f.id = c.fournisseur_id
    ORDER BY c.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-box-seam me-2"></i>Liste des commandes</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fournisseur</th>
                    <th>Date</th>
                    <th>Montant total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['nom_fournisseur']); ?></td>
                <td><?php echo $row['date_commande']; ?></td>
                <td><?php echo number_format($row['montant_total'], 2); ?> DH</td>
                <td>
                    <?php
                    $badges = array(
                        'en_attente' => 'badge-orange',
                        'recue'      => 'badge-green',
                        'annulee'    => 'badge-red'
                    );
                    $labels = array(
                        'en_attente' => 'En attente',
                        'recue'      => 'Reçue',
                        'annulee'    => 'Annulée'
                    );
                    $s = $row['statut'];
                    echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                    ?>
                </td>
                <td>
                    <a href="<?php echo $base_url; ?>commande/commande_detail.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-eye"></i> Détail
                    </a>
                    <a href="<?php echo $base_url; ?>commande/commande_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cette commande ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" style="text-align:center; color:#475569; padding:20px;">Aucune commande trouvée</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>