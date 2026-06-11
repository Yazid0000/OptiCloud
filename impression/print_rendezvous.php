<?php
require("../connexion.php");
$liste = mysqli_query($con, "SELECT r.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
    FROM rendezvous r JOIN patient p ON p.id = r.patient_id
    ORDER BY r.date_rdv DESC, r.heure_rdv");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des rendez-vous</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 4px; }
        .sous-titre { text-align: center; color: #666; margin-bottom: 16px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1a73e8; color: white; padding: 8px; text-align: left; font-size: 11px; }
        td { padding: 7px 8px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) td { background: #f5f5f5; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #999; }
    </style>
</head>
<body>
<h2>OPTI CLOUD — Liste des rendez-vous</h2>
<div class="sous-titre">Imprimé le <?php echo date('d/m/Y à H:i'); ?></div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Motif</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $labels = array('en_attente'=>'En attente','confirme'=>'Confirmé','termine'=>'Terminé','annule'=>'Annulé');
    while($row = mysqli_fetch_assoc($liste)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['patient_nom']); ?></td>
        <td><?php echo $row['date_rdv']; ?></td>
        <td><?php echo substr($row['heure_rdv'],0,5); ?></td>
        <td><?php echo htmlspecialchars($row['motif']); ?></td>
        <td><?php echo $labels[$row['statut']]; ?></td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<div class="footer">OPTI CLOUD &copy; <?php echo date('Y'); ?></div>
<script>window.onload = function(){ window.print(); }</script>
</body>
</html>