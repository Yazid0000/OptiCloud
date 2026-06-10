<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier une prescription";
$page_breadcrumb = "Patients / Prescriptions / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM prescription WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: /www/OPTI_CLOUD_PHP5/prescription/prescription_list.php");
    exit();
}
$presc = mysqli_fetch_assoc($res);

$patients  = mysqli_query($con, "SELECT id, CONCAT(prenom,' ',nom) AS nom_complet FROM patient ORDER BY nom, prenom");
$opticiens = mysqli_query($con, "SELECT id, CONCAT(prenom_opticien,' ',nom_opticien) AS nom_complet FROM opticien ORDER BY nom_opticien");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id  = isset($_POST['patient_id'])  ? intval($_POST['patient_id'])  : 0;
    $opticien_id = isset($_POST['opticien_id']) ? intval($_POST['opticien_id']) : 0;
    $date        = isset($_POST['date_prescription']) ? trim($_POST['date_prescription']) : '';
    $od_sph      = isset($_POST['od_sphere'])   ? trim($_POST['od_sphere'])   : '0';
    $od_cyl      = isset($_POST['od_cylindre']) ? trim($_POST['od_cylindre']) : '0';
    $od_axe      = isset($_POST['od_axe'])      ? intval($_POST['od_axe'])    : 0;
    $og_sph      = isset($_POST['og_sphere'])   ? trim($_POST['og_sphere'])   : '0';
    $og_cyl      = isset($_POST['og_cylindre']) ? trim($_POST['og_cylindre']) : '0';
    $og_axe      = isset($_POST['og_axe'])      ? intval($_POST['og_axe'])    : 0;
    $addition    = isset($_POST['addition'])    ? trim($_POST['addition'])    : '0';
    $note        = isset($_POST['note'])        ? trim($_POST['note'])        : '';

    if ($patient_id === 0 || $date === '') {
        $erreur = "Le patient et la date sont obligatoires.";
    } else {
        $note_s  = mysqli_real_escape_string($con, $note);
        $op_val  = $opticien_id > 0 ? $opticien_id : 'NULL';
        mysqli_query($con, "UPDATE prescription SET
            patient_id=$patient_id, date_prescription='$date',
            od_sphere='$od_sph', od_cylindre='$od_cyl', od_axe=$od_axe,
            og_sphere='$og_sph', og_cylindre='$og_cyl', og_axe=$og_axe,
            addition='$addition', opticien_id=$op_val, note='$note_s'
            WHERE id=$id");
        $succes = "Prescription modifiée avec succès.";
        $presc = array_merge($presc, array(
            'patient_id'=>$patient_id,'date_prescription'=>$date,
            'od_sphere'=>$od_sph,'od_cylindre'=>$od_cyl,'od_axe'=>$od_axe,
            'og_sphere'=>$og_sph,'og_cylindre'=>$og_cyl,'og_axe'=>$og_axe,
            'addition'=>$addition,'opticien_id'=>$opticien_id,'note'=>$note
        ));
    }
}

require("../layout.php");
?>

<div style="max-width:680px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier la prescription</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Patient *</label>
                        <select name="patient_id" class="form-select">
                            <option value="0">-- Choisir --</option>
                            <?php while($p = mysqli_fetch_assoc($patients)): ?>
                            <option value="<?php echo $p['id']; ?>"
                                <?php echo $p['id'] == $presc['patient_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($p['nom_complet']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" name="date_prescription" class="form-control" value="<?php echo $presc['date_prescription']; ?>">
                    </div>
                </div>

                <div style="background:#1e2130; border-radius:8px; padding:14px; margin-bottom:12px;">
                    <div style="color:#60a5fa; font-size:12px; font-weight:600; margin-bottom:10px;">OEIL DROIT (OD)</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
                        <div>
                            <label class="form-label">Sphère</label>
                            <input type="number" step="0.25" name="od_sphere" class="form-control" value="<?php echo $presc['od_sphere']; ?>">
                        </div>
                        <div>
                            <label class="form-label">Cylindre</label>
                            <input type="number" step="0.25" name="od_cylindre" class="form-control" value="<?php echo $presc['od_cylindre']; ?>">
                        </div>
                        <div>
                            <label class="form-label">Axe (°)</label>
                            <input type="number" min="0" max="180" name="od_axe" class="form-control" value="<?php echo $presc['od_axe']; ?>">
                        </div>
                    </div>
                </div>

                <div style="background:#1e2130; border-radius:8px; padding:14px; margin-bottom:12px;">
                    <div style="color:#60a5fa; font-size:12px; font-weight:600; margin-bottom:10px;">OEIL GAUCHE (OG)</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
                        <div>
                            <label class="form-label">Sphère</label>
                            <input type="number" step="0.25" name="og_sphere" class="form-control" value="<?php echo $presc['og_sphere']; ?>">
                        </div>
                        <div>
                            <label class="form-label">Cylindre</label>
                            <input type="number" step="0.25" name="og_cylindre" class="form-control" value="<?php echo $presc['og_cylindre']; ?>">
                        </div>
                        <div>
                            <label class="form-label">Axe (°)</label>
                            <input type="number" min="0" max="180" name="og_axe" class="form-control" value="<?php echo $presc['og_axe']; ?>">
                        </div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Addition</label>
                        <input type="number" step="0.25" name="addition" class="form-control" value="<?php echo $presc['addition']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Opticien</label>
                        <select name="opticien_id" class="form-select">
                            <option value="0">-- Choisir --</option>
                            <?php while($o = mysqli_fetch_assoc($opticiens)): ?>
                            <option value="<?php echo $o['id']; ?>"
                                <?php echo $o['id'] == $presc['opticien_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($o['nom_complet']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="2"><?php echo htmlspecialchars($presc['note']); ?></textarea>
                </div>

                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="<?php echo $base_url; ?>prescription/prescription_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>