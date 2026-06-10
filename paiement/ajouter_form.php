<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un paiement";
$page_breadcrumb = "Ventes / Paiements / <span>Ajouter</span>";

$erreur = "";
$succes = "";

// Vente pré-sélectionnée si on vient de vente_detail.php
$vente_id_pre = isset($_GET['vente_id']) ? intval($_GET['vente_id']) : 0;

$ventes = mysqli_query($con, "SELECT v.id, CONCAT(pa.prenom,' ',pa.nom) AS patient_nom, v.montant_total, v.montant_paye
    FROM vente v
    JOIN patient pa ON pa.id = v.patient_id
    WHERE v.statut != 'paye'
    ORDER BY v.id DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vente_id      = isset($_POST['vente_id'])      ? intval($_POST['vente_id'])      : 0;
    $montant       = isset($_POST['montant'])        ? floatval($_POST['montant'])     : 0;
    $date_paiement = isset($_POST['date_paiement']) ? trim($_POST['date_paiement'])   : '';
    $mode          = isset($_POST['mode'])           ? trim($_POST['mode'])            : 'especes';
    $note          = isset($_POST['note'])           ? trim($_POST['note'])            : '';

    if ($vente_id === 0 || $montant <= 0 || $date_paiement === '') {
        $erreur = "Vente, montant et date sont obligatoires.";
    } else {
        $note_s = mysqli_real_escape_string($con, $note);
        $mode_s = mysqli_real_escape_string($con, $mode);
        mysqli_query($con, "INSERT INTO paiement (vente_id, date_paiement, montant, mode, note)
                            VALUES ($vente_id, '$date_paiement', $montant, '$mode_s', '$note_s')");

        // Mettre à jour montant_paye et statut dans vente
        $res_v = mysqli_fetch_assoc(mysqli_query($con, "SELECT montant_total, montant_paye FROM vente WHERE id = $vente_id"));
        $nouveau_paye = $res_v['montant_paye'] + $montant;
        if ($nouveau_paye >= $res_v['montant_total']) {
            $statut = 'paye';
            $nouveau_paye = $res_v['montant_total'];
        } elseif ($nouveau_paye > 0) {
            $statut = 'partiel';
        } else {
            $statut = 'impaye';
        }
        mysqli_query($con, "UPDATE vente SET montant_paye = $nouveau_paye, statut = '$statut' WHERE id = $vente_id");
        $succes = "Paiement enregistré avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:560px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouveau paiement</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Vente *</label>
                    <select name="vente_id" class="form-select">
                        <option value="0">-- Choisir une vente --</option>
                        <?php while($v = mysqli_fetch_assoc($ventes)):
                            $reste = $v['montant_total'] - $v['montant_paye'];
                        ?>
                        <option value="<?php echo $v['id']; ?>"
                            <?php echo $v['id'] == $vente_id_pre ? 'selected' : ''; ?>>
                            #<?php echo $v['id']; ?> — <?php echo htmlspecialchars($v['patient_nom']); ?>
                            (Reste : <?php echo number_format($reste, 2); ?> DH)
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Montant (DH) *</label>
                        <input type="number" step="0.01" name="montant" class="form-control" placeholder="Ex: 500.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" name="date_paiement" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mode de paiement</label>
                    <select name="mode" class="form-select">
                        <option value="especes">Espèces</option>
                        <option value="carte">Carte bancaire</option>
                        <option value="cheque">Chèque</option>
                        <option value="mutuelle">Mutuelle</option>
                        <option value="virement">Virement</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Remarques..."></textarea>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="<?php echo $base_url; ?>paiement/paiement_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>