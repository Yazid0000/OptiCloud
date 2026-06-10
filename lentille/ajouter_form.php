<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter une lentille";
$page_breadcrumb = "Stock / Lentilles / <span>Ajouter</span>";

$erreur = "";
$succes = "";

$categories = mysqli_query($con, "SELECT * FROM categorie ORDER BY nom_categorie");
$marques    = mysqli_query($con, "SELECT * FROM marque ORDER BY nom_marque");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref       = isset($_POST['ref_lentille'])  ? trim($_POST['ref_lentille'])   : '';
    $prix      = isset($_POST['prix_lentille']) ? trim($_POST['prix_lentille'])  : '';
    $stock     = isset($_POST['stock'])         ? intval($_POST['stock'])        : 0;
    $id_cat    = isset($_POST['id_categorie'])  ? intval($_POST['id_categorie']) : 0;
    $id_marque = isset($_POST['id_marque'])     ? intval($_POST['id_marque'])    : 0;

    if ($ref === '' || $prix === '') {
        $erreur = "La référence et le prix sont obligatoires.";
    } else {
        $ref_s  = mysqli_real_escape_string($con, $ref);
        $prix_s = mysqli_real_escape_string($con, $prix);
        mysqli_query($con, "INSERT INTO lentille (ref_lentille, prix_lentille, stock, id_categorie, id_marque)
                            VALUES ('$ref_s', '$prix_s', $stock, $id_cat, $id_marque)");
        $succes = "Lentille ajoutée avec succès.";
    }
}

require("../layout.php");
?>

<div style="max-width:600px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouvelle lentille</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Référence *</label>
                    <input type="text" name="ref_lentille" class="form-control"
                           placeholder="Ex: LEN-001" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prix (DH) *</label>
                    <input type="number" step="0.01" name="prix_lentille" class="form-control"
                           placeholder="Ex: 120.00">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock initial</label>
                    <input type="number" name="stock" class="form-control" value="0" min="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select name="id_categorie" class="form-select">
                        <option value="0">-- Choisir --</option>
                        <?php while($c = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nom_categorie']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Marque</label>
                    <select name="id_marque" class="form-select">
                        <option value="0">-- Choisir --</option>
                        <?php while($m = mysqli_fetch_assoc($marques)): ?>
                        <option value="<?php echo $m['id']; ?>"><?php echo htmlspecialchars($m['nom_marque']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="lentille_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>
