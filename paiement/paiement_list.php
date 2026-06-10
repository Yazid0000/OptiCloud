<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Paiements";
$page_breadcrumb = "Ventes / <span>Paiements</span>";

$liste = mysqli_query($con, "SELECT p.*, CONCAT(pa.prenom,' ',pa.nom) AS patient_nom, v.montant_total
    FROM paiement p
    JOIN vente v ON v.id = p.vente_id
    JOIN patient pa ON pa.id = v.patient_id
    ORDER BY p.id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-cash-coin me-2"></i>Liste des paiements</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Vente #</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Mode</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['patient_nom']); ?></td>
                <td>
                    <a href="<?php echo $base_url; ?>vente/vente_detail.php?id=<?php echo $row['vente_id']; ?>" class="badge-blue" style="text-decoration:none;">
                        #<?php echo $row['vente_id']; ?>
                    </a>
                </td>
                <td><?php echo $row['date_paiement']; ?></td>
                <td><?php echo number_format($row['montant'], 2); ?> DH</td>
                <td>
                    <?php
                    $modes = array(
                        'especes'  => 'badge-green',
                        'carte'    => 'badge-blue',
                        'cheque'   => 'badge-gray',
                        'mutuelle' => 'badge-orange',
                        'virement' => 'badge-gray'
                    );
                    $m = $row['mode'];
                    echo '<span class="'.$modes[$m].'">'.ucfirst($m).'</span>';
                    ?>
                </td>
                <td><?php echo htmlspecialchars($row['note']); ?></td>
                <td>
                    <a href="<?php echo $base_url; ?>paiement/paiement_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer ce paiement ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="8" style="text-align:center; color:#475569; padding:20px;">Aucun paiement trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>