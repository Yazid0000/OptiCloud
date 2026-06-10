<?php
require("auth.php");
require("connexion.php");

$page_title      = "Tableau de bord";
$page_breadcrumb = "Accueil / <span>Dashboard</span>";

$res = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM patient"));
$nb_patients = $res[0];

$res = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM rendezvous WHERE date_rdv = CURDATE()"));
$nb_rdv = $res[0];

$res = mysqli_fetch_row(mysqli_query($con, "SELECT COALESCE(SUM(montant_total),0) FROM vente WHERE date_vente = CURDATE()"));
$ventes_jour = $res[0];

$res1 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM monture WHERE stock < 5"));
$res2 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM verre WHERE stock < 5"));
$res3 = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM lentille WHERE stock < 5"));
$nb_stock_faible = $res1[0] + $res2[0] + $res3[0];

require("layout.php");
?>

<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-people me-1"></i>Patients</div>
        <div class="stat-value"><?php echo $nb_patients; ?></div>
        <div class="stat-sub">Total enregistrés</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-cart3 me-1"></i>Ventes du jour</div>
        <div class="stat-value"><?php echo number_format($ventes_jour, 2); ?> DH</div>
        <div class="stat-sub">Aujourd'hui</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-calendar-check me-1"></i>RDV aujourd'hui</div>
        <div class="stat-value"><?php echo $nb_rdv; ?></div>
        <div class="stat-sub">Rendez-vous du jour</div>
    </div>
    <div class="stat-card">
        <div class="stat-label"><i class="bi bi-exclamation-triangle me-1"></i>Stock faible</div>
        <div class="stat-value"><?php echo $nb_stock_faible; ?></div>
        <div class="stat-sub <?php echo $nb_stock_faible > 0 ? 'warn' : ''; ?>">
            <?php echo $nb_stock_faible > 0 ? 'À réapprovisionner' : 'Stock OK'; ?>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:2fr 1fr; gap:16px;">

    <div class="card-dark">
        <div class="card-header"><i class="bi bi-cart3 me-2"></i>Dernières ventes</div>
        <div style="overflow-x:auto;">
            <table class="table-dark-custom">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $ventes = mysqli_query($con, "SELECT v.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
                    FROM vente v
                    JOIN patient p ON p.id = v.patient_id
                    ORDER BY v.id DESC LIMIT 8");
                if ($ventes && mysqli_num_rows($ventes) > 0):
                    while($v = mysqli_fetch_assoc($ventes)):
                ?>
                <tr>
                    <td class="primary-col"><?php echo htmlspecialchars($v['patient_nom']); ?></td>
                    <td><?php echo $v['date_vente']; ?></td>
                    <td><?php echo number_format($v['montant_total'],2); ?> DH</td>
                    <td>
                        <?php
                        $badges = array('paye'=>'badge-green','partiel'=>'badge-blue','impaye'=>'badge-red');
                        $labels = array('paye'=>'Payé','partiel'=>'Partiel','impaye'=>'Impayé');
                        $s = $v['statut'];
                        echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                        ?>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="4" style="text-align:center; color:#475569; padding:20px;">Aucune vente enregistrée</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-dark">
        <div class="card-header"><i class="bi bi-calendar-check me-2"></i>RDV du jour</div>
        <div style="padding:8px 0;">
        <?php
        $rdvs = mysqli_query($con, "SELECT r.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
            FROM rendezvous r
            JOIN patient p ON p.id = r.patient_id
            WHERE r.date_rdv = CURDATE()
            ORDER BY r.heure_rdv ASC LIMIT 8");
        if ($rdvs && mysqli_num_rows($rdvs) > 0):
            while($r = mysqli_fetch_assoc($rdvs)):
        ?>
        <div style="display:flex; align-items:center; gap:10px; padding:10px 16px; border-bottom:1px solid #1a1d29;">
            <div style="background:#1e3a5f; color:#60a5fa; border-radius:6px; padding:4px 8px; font-size:12px; font-weight:600; flex-shrink:0;">
                <?php echo substr($r['heure_rdv'],0,5); ?>
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px; color:#e2e8f0;"><?php echo htmlspecialchars($r['patient_nom']); ?></div>
                <div style="font-size:11px; color:#475569;"><?php echo htmlspecialchars($r['motif']); ?></div>
            </div>
        </div>
        <?php endwhile; else: ?>
        <div style="text-align:center; color:#475569; padding:20px; font-size:13px;">Aucun RDV aujourd'hui</div>
        <?php endif; ?>
        </div>
    </div>

</div>

<?php require("layout_end.php"); ?>