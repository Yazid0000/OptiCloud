<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Détail vente";
$page_breadcrumb = "Ventes / <span>Détail</span>";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT v.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
    FROM vente v JOIN patient p ON p.id = v.patient_id
    WHERE v.id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: /www/OPTI_CLOUD_PHP5/vente/vente_list.php");
    exit();
}
$vente = mysqli_fetch_assoc($res);

$details = mysqli_query($con, "SELECT * FROM vente_detail WHERE vente_id = $id");
$paiements = mysqli_query($con, "SELECT * FROM paiement WHERE vente_id = $id ORDER BY date_paiement DESC");

require("../layout.php");
?>

<div style="max-width:800px;">

    <!-- INFO VENTE -->
    <div class="card-dark" style="margin-bottom:16px;">
        <div class="card-header"><i class="bi bi-receipt me-2"></i>Vente #<?php echo $vente['id']; ?></div>
        <div style="padding:16px; display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:12px;">
            <div>
                <div style="color:#64748b; font-size:11px;">Patient</div>
                <div style="color:#e2e8f0; font-size:13px; font-weight:500;"><?php echo htmlspecialchars($vente['patient_nom']); ?></div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Date</div>
                <div style="color:#e2e8f0; font-size:13px;"><?php echo $vente['date_vente']; ?></div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Montant total</div>
                <div style="color:#e2e8f0; font-size:13px; font-weight:500;"><?php echo number_format($vente['montant_total'], 2); ?> DH</div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Statut</div>
                <?php
                $badges = array('paye'=>'badge-green','partiel'=>'badge-blue','impaye'=>'badge-red');
                $labels = array('paye'=>'Payé','partiel'=>'Partiel','impaye'=>'Impayé');
                $s = $vente['statut'];
                echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                ?>
            </div>
        </div>
    </div>

    <!-- PRODUITS -->
    <div class="card-dark" style="margin-bottom:16px;">
        <div class="card-header"><i class="bi bi-box-seam me-2"></i>Produits</div>
        <div style="overflow-x:auto;">
            <table class="table-dark-custom">
                <thead>
                    <tr><th>Type</th><th>Référence</th><th>Qté</th><th>Prix unit.</th><th>Sous-total</th></tr>
                </thead>
                <tbody>
                <?php if ($details && mysqli_num_rows($details) > 0):
                    while($d = mysqli_fetch_assoc($details)):
                        // Récupérer la référence du produit
                        if ($d['type_produit'] === 'monture') {
                            $pr = mysqli_fetch_assoc(mysqli_query($con, "SELECT ref_monture AS ref FROM monture WHERE id = ".$d['produit_id']));
                        } elseif ($d['type_produit'] === 'verre') {
                            $pr = mysqli_fetch_assoc(mysqli_query($con, "SELECT ref_verre AS ref FROM verre WHERE id = ".$d['produit_id']));
                        } else {
                            $pr = mysqli_fetch_assoc(mysqli_query($con, "SELECT ref_lentille AS ref FROM lentille WHERE id = ".$d['produit_id']));
                        }
                        $ref = $pr ? $pr['ref'] : 'N/A';
                ?>
                <tr>
                    <td><span class="badge-blue"><?php echo ucfirst($d['type_produit']); ?></span></td>
                    <td class="primary-col"><?php echo htmlspecialchars($ref); ?></td>
                    <td><?php echo $d['quantite']; ?></td>
                    <td><?php echo number_format($d['prix_unitaire'], 2); ?> DH</td>
                    <td><?php echo number_format($d['quantite'] * $d['prix_unitaire'], 2); ?> DH</td>
                </tr>
                <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAIEMENTS -->
    <div class="card-dark">
        <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
            <span><i class="bi bi-cash-coin me-2"></i>Paiements</span>
            <a href="<?php echo $base_url; ?>paiement/ajouter_form.php?vente_id=<?php echo $vente['id']; ?>" class="btn-primary-dark" style="font-size:12px; padding:6px 12px;">
                <i class="bi bi-plus"></i> Ajouter un paiement
            </a>
        </div>
        <div style="overflow-x:auto;">
            <table class="table-dark-custom">
                <thead>
                    <tr><th>Date</th><th>Montant</th><th>Mode</th><th>Note</th></tr>
                </thead>
                <tbody>
                <?php if ($paiements && mysqli_num_rows($paiements) > 0):
                    while($p = mysqli_fetch_assoc($paiements)): ?>
                <tr>
                    <td><?php echo $p['date_paiement']; ?></td>
                    <td class="primary-col"><?php echo number_format($p['montant'], 2); ?> DH</td>
                    <td><span class="badge-gray"><?php echo ucfirst($p['mode']); ?></span></td>
                    <td><?php echo htmlspecialchars($p['note']); ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="4" style="text-align:center; color:#475569; padding:16px;">Aucun paiement enregistré</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div style="padding:14px 16px; border-top:1px solid #2a2d3a; display:flex; justify-content:flex-end; gap:24px;">
            <span style="color:#64748b; font-size:13px;">Total payé : <strong style="color:#4ade80;"><?php echo number_format($vente['montant_paye'], 2); ?> DH</strong></span>
            <span style="color:#64748b; font-size:13px;">Reste : <strong style="color:#f87171;"><?php echo number_format($vente['montant_total'] - $vente['montant_paye'], 2); ?> DH</strong></span>
        </div>
    </div>

    <div style="margin-top:16px;">
        <a href="<?php echo $base_url; ?>vente/vente_list.php" class="btn-secondary-dark">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

<?php require("../layout_end.php"); ?>