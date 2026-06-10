<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier un rendez-vous";
$page_breadcrumb = "Patients / Rendez-vous / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM rendezvous WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: /www/OPTI_CLOUD_PHP5/rendezvous/rendezvous_list.php");
    exit();
}
$rdv = mysqli_fetch_assoc($res);

$patients = mysqli_query($con, "SELECT id, CONCAT(prenom,' ',nom) AS nom_complet FROM patient ORDER BY nom, prenom");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;
    $date_rdv   = isset($_POST['date_rdv'])   ? trim($_POST['date_rdv'])     : '';
    $heure_rdv  = isset($_POST['heure_rdv'])  ? trim($_POST['heure_rdv'])    : '';
    $motif      = isset($_POST['motif'])      ? trim($_POST['motif'])        : '';
    $statut     = isset($_POST['statut'])     ? trim($_POST['statut'])       : 'en_attente';
    $note       = isset($_POST['note'])       ? trim($_POST['note'])         : '';

    if ($patient_id === 0 || $date_rdv === '' || $heure_rdv === '') {
        $erreur = "Patient, date et heure sont obligatoires.";
    } else {
        $motif_s  = mysqli_real_escape_string($con, $motif);
        $note_s   = mysqli_real_escape_string($con, $note);
        $statut_s = mysqli_real_escape_string($con, $statut);
        mysqli_query($con, "UPDATE rendezvous SET
            patient_id=$patient_id, date_rdv='$date_rdv', heure_rdv='$heure_rdv',
            motif='$motif_s', statut='$statut_s', note='$note_s'
            WHERE id=$id");
        $succes = "Rendez-vous modifié avec succès.";
        $rdv = array_merge($rdv, array(
            'patient_id'=>$patient_id,'date_rdv'=>$date_rdv,
            'heure_rdv'=>$heure_rdv,'motif'=>$motif,
            'statut'=>$statut,'note'=>$note
        ));
    }
}

require("../layout.php");
?>

<div style="max-width:560px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier le rendez-vous</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Patient *</label>
                    <select name="patient_id" class="form-select">
                        <option value="0">-- Choisir un patient --</option>
                        <?php while($p = mysqli_fetch_assoc($patients)): ?>
                        <option value="<?php echo $p['id']; ?>"
                            <?php echo $p['id'] == $rdv['patient_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($p['nom_complet']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" name="date_rdv" class="form-control" value="<?php echo $rdv['date_rdv']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure *</label>
                        <input type="time" name="heure_rdv" class="form-control" value="<?php echo substr($rdv['heure_rdv'],0,5); ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Motif</label>
                    <input type="text" name="motif" class="form-control" value="<?php echo htmlspecialchars($rdv['motif']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="en_attente" <?php echo $rdv['statut']=='en_attente' ? 'selected' : ''; ?>>En attente</option>
                        <option value="confirme"   <?php echo $rdv['statut']=='confirme'   ? 'selected' : ''; ?>>Confirmé</option>
                        <option value="termine"    <?php echo $rdv['statut']=='termine'    ? 'selected' : ''; ?>>Terminé</option>
                        <option value="annule"     <?php echo $rdv['statut']=='annule'     ? 'selected' : ''; ?>>Annulé</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3"><?php echo htmlspecialchars($rdv['note']); ?></textarea>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="<?php echo $base_url; ?>rendezvous/rendezvous_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>