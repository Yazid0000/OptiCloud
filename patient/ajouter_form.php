<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un patient";
$page_breadcrumb = "Patients / <span>Ajouter</span>";

$erreur = "";
$succes = "";

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
        mysqli_query($con, "INSERT INTO patient (nom, prenom, date_naissance, telephone, email, adresse, mutuelle, note)
                            VALUES ('$nom_s','$prenom_s','$dob_s','$tel_s','$email_s','$adresse_s','$mutuelle_s','$note_s')");
        $succes = "Patient ajouté avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouveau patient</div>
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
                        <input type="text" name="nom" class="form-control" placeholder="Ex: Benali" autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenom" class="form-control" placeholder="Ex: Ahmed">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Téléphone *</label>
                        <input type="text" name="telephone" class="form-control" placeholder="Ex: 0661000000">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de naissance *</label>
                        <input type="date" name="date_naissance" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ex: patient@email.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Ex: 12 Rue Hassan II, Tétouan">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mutuelle</label>
                    <input type="text" name="mutuelle" class="form-control" placeholder="Ex: CNOPS, CNSS">
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Informations complémentaires..."></textarea>
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