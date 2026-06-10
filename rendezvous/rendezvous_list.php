<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Rendez-vous";
$page_breadcrumb = "Patients / <span>Rendez-vous</span>";
$btn_action      = "Ajouter un rendez-vous";
$btn_action_url  = "rendezvous/ajouter_form.php";

$liste = mysqli_query($con, "SELECT r.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
    FROM rendezvous r
    JOIN patient p ON p.id = r.patient_id
    ORDER BY r.date_rdv DESC, r.heure_rdv DESC");

require("../layout.php");
?>

<div class="card-dark">
    <div class="card-header"><i class="bi bi-calendar-check me-2"></i>Liste des rendez-vous</div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($liste && mysqli_num_rows($liste) > 0):
                while($row = mysqli_fetch_assoc($liste)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="primary-col"><?php echo htmlspecialchars($row['patient_nom']); ?></td>
                <td><?php echo $row['date_rdv']; ?></td>
                <td><?php echo substr($row['heure_rdv'], 0, 5); ?></td>
                <td><?php echo htmlspecialchars($row['motif']); ?></td>
                <td>
                    <?php
                    $badges = array(
                        'en_attente' => 'badge-orange',
                        'confirme'   => 'badge-blue',
                        'termine'    => 'badge-green',
                        'annule'     => 'badge-red'
                    );
                    $labels = array(
                        'en_attente' => 'En attente',
                        'confirme'   => 'Confirmé',
                        'termine'    => 'Terminé',
                        'annule'     => 'Annulé'
                    );
                    $s = $row['statut'];
                    echo '<span class="'.$badges[$s].'">'.$labels[$s].'</span>';
                    ?>
                </td>
                <td>
                    <a href="<?php echo $base_url; ?>rendezvous/rendezvous_modifier.php?id=<?php echo $row['id']; ?>" class="btn-secondary-dark" style="margin-right:6px;">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="<?php echo $base_url; ?>rendezvous/rendezvous_delete.php?id=<?php echo $row['id']; ?>"
                       class="btn-danger-dark"
                       onclick="return confirm('Supprimer ce rendez-vous ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="7" style="text-align:center; color:#475569; padding:20px;">Aucun rendez-vous trouvé</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require("../layout_end.php"); ?>