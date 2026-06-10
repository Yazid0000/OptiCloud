<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter une marque";
$page_breadcrumb = "Stock / Marques / <span>Ajouter</span>";

$erreur = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom_marque']) ? trim($_POST['nom_marque']) : '';
    if ($nom === '') {
        $erreur = "Le nom de la marque est obligatoire.";
    } else {
        $nom_s = mysqli_real_escape_string($con, $nom);
        mysqli_query($con, "INSERT INTO marque (nom_marque) VALUES ('$nom_s')");
        $succes = "Marque ajoutée avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouvelle marque</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Nom de la marque *</label>
                    <input type="text" name="nom_marque" class="form-control"
                           placeholder="Ex: Ray-Ban" autofocus>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="marque_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>