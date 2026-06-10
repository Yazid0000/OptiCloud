<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ventes";
$page_breadcrumb = "Ventes / <span>Liste</span>";
$btn_action      = "Nouvelle vente";
$btn_action_url  = "vente/ajouter_form.php";

$liste = mysqli_query($con, "SELECT v.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
    FROM vente v
    JOIN patient p ON p.id = v.patient_id
    ORDER BY v.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-cart3 me-2"></i>Liste des ventes</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Montant total</th>
                    <th>Montant payé</th>
                    <th>Reste</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)):
                $reste = $row['montant_total'] - $row['montant_paye'];
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['patient_nom']); ?></td>
                <td><?php echo $row['date_vente']; ?></td>
                <td><?php echo number_format($row['montant_total'], 2); ?> DH</td>
                <td><?php echo number_format($row['montant_paye'], 2); ?> DH</td>
                <td><?php echo number_format($reste, 2); ?> DH</td>
                <td>
                    <?php
                    $badges = array('paye'=>'badge-green','partiel'=>'badge-blue','impaye'=>'badge-red');
                    $labels = array('paye'=>'Payé','partiel'=>'Partiel','impaye'=>'Impayé');
                    $s = $row['statut'];
                    echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                    ?>
                </td>
                <td>
                    <a href="<?php echo $base_url; ?>vente/vente_detail.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-eye"></i> Détail
                    </a>
                    <a href="<?php echo $base_url; ?>vente/vente_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cette vente ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="8" style="text-align:center; color:#475569; padding:20px;">Aucune vente trouvée</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>