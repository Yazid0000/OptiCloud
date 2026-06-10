<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Modifier un utilisateur";
$page_breadcrumb = "Administration / Utilisateurs / <span>Modifier</span>";

$erreur = "";
$succes = "";

$id  = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($con, "SELECT * FROM utilisateurs WHERE id = $id");
if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: /www/OPTI_CLOUD_PHP5/utilisateur/utilisateur_list.php");
    exit();
}
$user = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = isset($_POST['nom'])      ? trim($_POST['nom'])      : '';
    $login    = isset($_POST['login'])    ? trim($_POST['login'])    : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role     = isset($_POST['role'])     ? trim($_POST['role'])     : 'employe';
    $actif    = isset($_POST['actif'])    ? intval($_POST['actif'])  : 1;

    if ($nom === '' || $login === '') {
        $erreur = "Nom et login sont obligatoires.";
    } else {
        $nom_s   = mysqli_real_escape_string($con, $nom);
        $login_s = mysqli_real_escape_string($con, $login);
        $role_s  = mysqli_real_escape_string($con, $role);

        // Vérifier login unique (sauf pour cet utilisateur)
        $check = mysqli_query($con, "SELECT id FROM utilisateurs WHERE login = '$login_s' AND id != $id");
        if (mysqli_num_rows($check) > 0) {
            $erreur = "Ce login est déjà utilisé.";
        } else {
            if ($password !== '') {
                $mdp = md5($password);
                mysqli_query($con, "UPDATE utilisateurs SET
                    nom='$nom_s', login='$login_s', mot_de_passe='$mdp',
                    role='$role_s', actif=$actif WHERE id=$id");
            } else {
                mysqli_query($con, "UPDATE utilisateurs SET
                    nom='$nom_s', login='$login_s',
                    role='$role_s', actif=$actif WHERE id=$id");
            }
            $succes = "Utilisateur modifié avec succès.";
            $user = array_merge($user, array(
                'nom'=>$nom,'login'=>$login,'role'=>$role,'actif'=>$actif
            ));
        }
    }
}

require("../layout.php");
?>

<div style="max-width:500px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-pencil me-2"></i>Modifier l'utilisateur</div>
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
                    <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($user['nom']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Login *</label>
                    <input type="text" name="login" class="form-control" value="<?php echo htmlspecialchars($user['login']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Laisser vide pour ne pas changer">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select">
                            <option value="employe" <?php echo $user['role']=='employe' ? 'selected' : ''; ?>>Employé</option>
                            <option value="admin"   <?php echo $user['role']=='admin'   ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="actif" class="form-select">
                            <option value="1" <?php echo $user['actif']==1 ? 'selected' : ''; ?>>Actif</option>
                            <option value="0" <?php echo $user['actif']==0 ? 'selected' : ''; ?>>Inactif</option>
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