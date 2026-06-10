<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un rendez-vous";
$page_breadcrumb = "Patients / Rendez-vous / <span>Ajouter</span>";

$erreur = "";
$succes = "";

$patients = mysqli_query($con, "SELECT id, CONCAT(prenom,' ',nom) AS nom_complet FROM patient ORDER BY nom, prenom");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id'])       : 0;
    $date_rdv   = isset($_POST['date_rdv'])   ? trim($_POST['date_rdv'])           : '';
    $heure_rdv  = isset($_POST['heure_rdv'])  ? trim($_POST['heure_rdv'])          : '';
    $motif      = isset($_POST['motif'])      ? trim($_POST['motif'])              : '';
    $statut     = isset($_POST['statut'])     ? trim($_POST['statut'])             : 'en_attente';
    $note       = isset($_POST['note'])       ? trim($_POST['note'])               : '';

    if ($patient_id === 0 || $date_rdv === '' || $heure_rdv === '') {
        $erreur = "Patient, date et heure sont obligatoires.";
    } else {
        $motif_s  = mysqli_real_escape_string($con, $motif);
        $note_s   = mysqli_real_escape_string($con, $note);
        $statut_s = mysqli_real_escape_string($con, $statut);
        mysqli_query($con, "INSERT INTO rendezvous (patient_id, date_rdv, heure_rdv, motif, statut, note)
                            VALUES ($patient_id, '$date_rdv', '$heure_rdv', '$motif_s', '$statut_s', '$note_s')");
        $succes = "Rendez-vous ajouté avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:560px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouveau rendez-vous</div>
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
                        <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nom_complet']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" name="date_rdv" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure *</label>
                        <input type="time" name="heure_rdv" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Motif</label>
                    <input type="text" name="motif" class="form-control" placeholder="Ex: Contrôle de vue">
                </div>
                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="en_attente">En attente</option>
                        <option value="confirme">Confirmé</option>
                        <option value="termine">Terminé</option>
                        <option value="annule">Annulé</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Informations complémentaires..."></textarea>
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