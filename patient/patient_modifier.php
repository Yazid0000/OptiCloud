<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier un patient";
$page_breadcrumb = "Patients / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM patient WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: " . $base_url . "patient/patient_list.php");
    exit();
}
$patient = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = isset($_POST['nom'])      ? trim($_POST['nom'])      : '';
    $prenom   = isset($_POST['prenom'])   ? trim($_POST['prenom'])   : '';
    $tel      = isset($_POST['telephone'])? trim($_POST['telephone']): '';
    $email    = isset($_POST['email'])    ? trim($_POST['email'])    : '';
    $adresse  = isset($_POST['adresse'])  ? trim($_POST['adresse'])  : '';
    $mutuelle = isset($_POST['mutuelle']) ? trim($_POST['mutuelle']) : '';
    $note     = isset($_POST['note'])     ? trim($_POST['note'])     : '';
    $dob      = isset($_POST['date_naissance']) ? trim($_POST['date_naissance']) : '';

    if ($nom === '' || $prenom === '' || $tel === '' || $dob === '') {
        $erreur = "Nom, prénom, téléphone et date de naissance sont obligatoires.";
    } else {
        $nom_s      = mysqli_real_escape_string($con, $nom);
        $prenom_s   = mysqli_real_escape_string($con, $prenom);
        $tel_s      = mysqli_real_escape_string($con, $tel);
        $email_s    = mysqli_real_escape_string($con, $email);
        $adresse_s  = mysqli_real_escape_string($con, $adresse);
        $mutuelle_s = mysqli_real_escape_string($con, $mutuelle);
        $note_s     = mysqli_real_escape_string($con, $note);
        $dob_s      = mysqli_real_escape_string($con, $dob);
        mysqli_query($con, "UPDATE patient SET
            nom='$nom_s', prenom='$prenom_s', date_naissance='$dob_s',
            telephone='$tel_s', email='$email_s', adresse='$adresse_s',
            mutuelle='$mutuelle_s', note='$note_s'
            WHERE id=$id");
        $succes = "Patient modifié avec succès.";
        $patient = array_merge($patient, array(
            'nom'=>$nom,'prenom'=>$prenom,'date_naissance'=>$dob,
            'telephone'=>$tel,'email'=>$email,'adresse'=>$adresse,
            'mutuelle'=>$mutuelle,'note'=>$note
        ));
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier le patient</div>
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
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($patient['nom']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenom" class="form-control" value="<?php echo htmlspecialchars($patient['prenom']); ?>">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Téléphone *</label>
                        <input type="text" name="telephone" class="form-control" value="<?php echo htmlspecialchars($patient['telephone']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de naissance *</label>
                        <input type="date" name="date_naissance" class="form-control" value="<?php echo $patient['date_naissance']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($patient['email']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="<?php echo htmlspecialchars($patient['adresse']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mutuelle</label>
                    <input type="text" name="mutuelle" class="form-control" value="<?php echo htmlspecialchars($patient['mutuelle']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3"><?php echo htmlspecialchars($patient['note']); ?></textarea>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="<?php echo $base_url; ?>patient/patient_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>