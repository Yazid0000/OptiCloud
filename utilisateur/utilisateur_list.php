<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Utilisateurs";
$page_breadcrumb = "Administration / <span>Utilisateurs</span>";
$btn_action      = "Ajouter un utilisateur";
$btn_action_url  = "utilisateur/ajouter_form.php";

$liste = mysqli_query($con, "SELECT * FROM utilisateurs ORDER BY id DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-person-gear me-2"></i>Liste des utilisateurs</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Login</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['login']); ?></td>
                <td>
                    <?php if ($row['role'] === 'admin'): ?>
                        <span class="badge-blue">Admin</span>
                    <?php else: ?>
                        <span class="badge-gray">Employé</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($row['actif'] == 1): ?>
                        <span class="badge-green">Actif</span>
                    <?php else: ?>
                        <span class="badge-red">Inactif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo $base_url; ?>utilisateur/utilisateur_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <?php if ($row['id'] != $_SESSION['user_id']): ?>
                    <a href="<?php echo $base_url; ?>utilisateur/utilisateur_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer cet utilisateur ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" style="text-align:center; color:#475569; padding:20px;">Aucun utilisateur trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>