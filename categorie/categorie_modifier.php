<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier une catégorie";
$page_breadcrumb = "Stock / Catégories / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM categorie WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: categorie_list.php");
    exit();
}
$categorie = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom_categorie']) ? trim($_POST['nom_categorie']) : '';
    if ($nom === '') {
        $erreur = "Le nom de la catégorie est obligatoire.";
    } else {
        $nom_safe = mysqli_real_escape_string($con, $nom);
        mysqli_query($con, "UPDATE categorie SET nom_categorie='$nom_safe' WHERE id=$id");
        $succes = "Catégorie modifiée avec succès.";
        $categorie['nom_categorie'] = $nom;
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier la catégorie</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Nom de la catégorie</label>
                    <input type="text" name="nom_categorie" class="form-control"
                           value="<?php echo htmlspecialchars($categorie['nom_categorie']); ?>">
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="categorie_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>