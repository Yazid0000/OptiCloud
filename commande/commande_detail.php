<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Détail commande";
$page_breadcrumb = "Fournisseurs / Commandes / <span>Détail</span>";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT c.*, f.nom_fournisseur
    FROM commande c
    JOIN fournisseur f ON f.id = c.fournisseur_id
    WHERE c.id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: /www/OPTI_CLOUD_PHP5/commande/commande_list.php");
    exit();
}
$commande = mysqli_fetch_assoc($res);

// Changer statut si demandé
if (isset($_GET['statut'])) {
    $nouveau_statut = mysqli_real_escape_string($con, $_GET['statut']);
    $statuts_valides = array('en_attente', 'recue', 'annulee');
    if (in_array($nouveau_statut, $statuts_valides)) {
        // Si on passe à "recue", incrémenter le stock
        if ($nouveau_statut === 'recue' && $commande['statut'] !== 'recue') {
            $details_stock = mysqli_query($con, "SELECT * FROM commande_detail WHERE commande_id = $id");
            while($d = mysqli_fetch_assoc($details_stock)) {
                $qte = $d['quantite'];
                $pid = $d['produit_id'];
                if ($d['type_produit'] === 'monture') {
                    mysqli_query($con, "UPDATE monture SET stock = stock + $qte WHERE id = $pid");
                } elseif ($d['type_produit'] === 'verre') {
                    mysqli_query($con, "UPDATE verre SET stock = stock + $qte WHERE id = $pid");
                } elseif ($d['type_produit'] === 'lentille') {
                    mysqli_query($con, "UPDATE lentille SET stock = stock + $qte WHERE id = $pid");
                }
            }
        }
        mysqli_query($con, "UPDATE commande SET statut = '$nouveau_statut' WHERE id = $id");
        $commande['statut'] = $nouveau_statut;
    }
}

$details = mysqli_query($con, "SELECT * FROM commande_detail WHERE commande_id = $id");

require("../layout.php");
?>

<div style="max-width:800px;">

    <!-- INFO COMMANDE -->
    <div class="card-dark" style="margin-bottom:16px;">
        <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
            <span><i class="bi bi-box-seam me-2"></i>Commande #<?php echo $commande['id']; ?></span>
            <div style="display:flex; gap:8px;">
                <?php if ($commande['statut'] === 'en_attente'): ?>
                <a href="?id=<?php echo $id; ?>&statut=recue" class="btn-primary-dark" style="font-size:12px; padding:6px 12px;"
                   onclick="return confirm('Marquer comme reçue ? Le stock sera mis à jour.')">
                    <i class="bi bi-check-circle"></i> Marquer reçue
                </a>
                <a href="?id=<?php echo $id; ?>&statut=annulee" class="btn-danger-dark" style="font-size:12px; padding:6px 12px;"
                   onclick="return confirm('Annuler cette commande ?')">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div style="padding:16px; display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:12px;">
            <div>
                <div style="color:#64748b; font-size:11px;">Fournisseur</div>
                <div style="color:#e2e8f0; font-size:13px; font-weight:500;"><?php echo htmlspecialchars($commande['nom_fournisseur']); ?></div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Date</div>
                <div style="color:#e2e8f0; font-size:13px;"><?php echo $commande['date_commande']; ?></div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Montant total</div>
                <div style="color:#e2e8f0; font-size:13px; font-weight:500;"><?php echo number_format($commande['montant_total'], 2); ?> DH</div>
            </div>
            <div>
                <div style="color:#64748b; font-size:11px;">Statut</div>
                <?php
                $badges = array('en_attente'=>'badge-orange','recue'=>'badge-green','annulee'=>'badge-red');
                $labels = array('en_attente'=>'En attente','recue'=>'Reçue','annulee'=>'Annulée');
                $s = $commande['statut'];
                echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                ?>
            </div>
        </div>
        <?php if ($commande['note']): ?>
        <div style="padding:0 16px 16px; color:#64748b; font-size:13px;">
            <i class="bi bi-chat-left-text me-1"></i><?php echo htmlspecialchars($commande['note']); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- PRODUITS COMMANDÉS -->
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-list-ul me-2"></i>Produits commandés</div>
        <div style="overflow-x:auto;">
            <table class="table-dark-custom">
                <thead>
                    <tr><th>Type</th><th>Référence</th><th>Qté</th><th>Prix unit.</th><th>Sous-total</th></tr>
                </thead>
                <tbody>
                <?php if ($details && mysqli_num_rows($details) > 0):
                    while($d = mysqli_fetch_assoc($details)):
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
                <?php endwhile; else: ?>
                <tr><td colspan="5" style="text-align:center; color:#475569; padding:16px;">Aucun produit</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top:16px;">
        <a href="<?php echo $base_url; ?>commande/commande_list.php" class="btn-secondary-dark">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

<?php require("../layout_end.php"); ?>