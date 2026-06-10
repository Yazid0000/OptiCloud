<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un opticien";
$page_breadcrumb = "Administration / Opticiens / <span>Ajouter</span>";

$erreur = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom    = isset($_POST['nom_opticien'])    ? trim($_POST['nom_opticien'])    : '';
    $prenom = isset($_POST['prenom_opticien']) ? trim($_POST['prenom_opticien']) : '';
    $tel    = isset($_POST['tel_opticien'])    ? trim($_POST['tel_opticien'])    : '';
    $email  = isset($_POST['email_opticien'])  ? trim($_POST['email_opticien'])  : '';

    if ($nom === '' || $prenom === '') {
        $erreur = "Le nom et le prénom sont obligatoires.";
    } else {
        $nom_s    = mysqli_real_escape_string($con, $nom);
        $prenom_s = mysqli_real_escape_string($con, $prenom);
        $tel_s    = mysqli_real_escape_string($con, $tel);
        $email_s  = mysqli_real_escape_string($con, $email);
        mysqli_query($con, "INSERT INTO opticien (nom_opticien, prenom_opticien, tel_opticien, email_opticien)
                            VALUES ('$nom_s','$prenom_s','$tel_s','$email_s')");
        $succes = "Opticien ajouté avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouvel opticien</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="nom_opticien" class="form-control"
                           placeholder="Ex: Benali" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prénom *</label>
                    <input type="text" name="prenom_opticien" class="form-control"
                           placeholder="Ex: Karim">
                </div>
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="tel_opticien" class="form-control"
                           placeholder="Ex: 0661 000 000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_opticien" class="form-control"
                           placeholder="Ex: karim@opticloud.ma">
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="opticien_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>