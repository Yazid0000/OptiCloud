<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier un fournisseur";
$page_breadcrumb = "Fournisseurs / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM fournisseur WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: fournisseur_list.php");
    exit();
}
$fournisseur = mysqli_fetch_assoc($res);

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
        mysqli_query($con, "UPDATE fournisseur SET
            nom_fournisseur='$nom_s',
            tel_fournisseur='$tel_s',
            email_fournisseur='$email_s',
            ville_fournisseur='$ville_s'
            WHERE id=$id");
        $succes = "Fournisseur modifié avec succès.";
        $fournisseur = array_merge($fournisseur, array(
            'nom_fournisseur'   => $nom,
            'tel_fournisseur'   => $tel,
            'email_fournisseur' => $email,
            'ville_fournisseur' => $ville
        ));
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier le fournisseur</div>
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
                           value="<?php echo htmlspecialchars($fournisseur['nom_fournisseur']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="tel_fournisseur" class="form-control"
                           value="<?php echo htmlspecialchars($fournisseur['tel_fournisseur']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_fournisseur" class="form-control"
                           value="<?php echo htmlspecialchars($fournisseur['email_fournisseur']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville_fournisseur" class="form-control"
                           value="<?php echo htmlspecialchars($fournisseur['ville_fournisseur']); ?>">
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