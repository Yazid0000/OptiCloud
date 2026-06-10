<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Ajouter un utilisateur";
$page_breadcrumb = "Administration / Utilisateurs / <span>Ajouter</span>";

$erreur = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = isset($_POST['nom'])      ? trim($_POST['nom'])      : '';
    $login    = isset($_POST['login'])    ? trim($_POST['login'])    : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role     = isset($_POST['role'])     ? trim($_POST['role'])     : 'employe';
    $actif    = isset($_POST['actif'])    ? intval($_POST['actif'])  : 1;

    if ($nom === '' || $login === '' || $password === '') {
        $erreur = "Nom, login et mot de passe sont obligatoires.";
    } else {
        // Vérifier si le login existe déjà
        $login_s = mysqli_real_escape_string($con, $login);
        $check = mysqli_query($con, "SELECT id FROM utilisateurs WHERE login = '$login_s'");
        if (mysqli_num_rows($check) > 0) {
            $erreur = "Ce login est déjà utilisé.";
        } else {
            $nom_s   = mysqli_real_escape_string($con, $nom);
            $role_s  = mysqli_real_escape_string($con, $role);
            $mdp     = md5($password);
            mysqli_query($con, "INSERT INTO utilisateurs (nom, login, mot_de_passe, role, actif)
                                VALUES ('$nom_s', '$login_s', '$mdp', '$role_s', $actif)");
            $succes = "Utilisateur ajouté avec succès.";
        }
    }
}

require("../layout.php");
?>

<div style="max-width:500px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouvel utilisateur</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark">
                <div class="mb-3">
                    <label class="form-label">Nom complet *</label>
                    <input type="text" name="nom" class="form-control" placeholder="Ex: Mohamed Alami" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Login *</label>
                    <input type="text" name="login" class="form-control" placeholder="Ex: malami">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select">
                            <option value="employe">Employé</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="actif" class="form-select">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                    <a href="<?php echo $base_url; ?>utilisateur/utilisateur_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../layout_end.php"); ?>