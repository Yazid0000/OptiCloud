<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un fournisseur";
$page_breadcrumb = "Fournisseurs / <span>Ajouter</span>";

$erreur = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom   = isset($_POST['nom_fournisseur'])   ? trim($_POST['nom_fournisseur'])   : '';
    $tel   = isset($_POST['tel_fournisseur'])   ? trim($_POST['tel_fournisseur'])   : '';
    $email = isset($_POST['email_fournisseur']) ? trim($_POST['email_fournisseur']) : '';
    $ville = isset($_POST['ville_fournisseur']) ? trim($_POST['ville_fournisseur']) : '';

    if ($nom === '') {
        $erreur = "Le nom du fournisseur est obligatoire.";
    } else {
        $nom_s   = mysqli_real_escape_string($con, $nom);
        $tel_s   = mysqli_real_escape_string($con, $tel);
        $email_s = mysqli_real_escape_string($con, $email);
        $ville_s = mysqli_real_escape_string($con, $ville);
        mysqli_query($con, "INSERT INTO fournisseur (nom_fournisseur, tel_fournisseur, email_fournisseur, ville_fournisseur)
                            VALUES ('$nom_s','$tel_s','$email_s','$ville_s')");
        $succes = "Fournisseur ajouté avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouveau fournisseur</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Nom du fournisseur *</label>
                    <input type="text" name="nom_fournisseur" class="form-control"
                           placeholder="Ex: Essilor Maroc" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="tel_fournisseur" class="form-control"
                           placeholder="Ex: 0522 000 000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_fournisseur" class="form-control"
                           placeholder="Ex: contact@fournisseur.ma">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville_fournisseur" class="form-control"
                           placeholder="Ex: Casablanca">
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="fournisseur_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>
