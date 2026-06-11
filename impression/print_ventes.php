<?php
require("../connexion.php");
$liste = mysqli_query($con, "SELECT v.*, CONCAT(p.prenom,' ',p.nom) AS patient_nom
    FROM vente v JOIN patient p ON p.id = v.patient_id
    ORDER BY v.date_vente DESC");
$total_general = mysqli_fetch_row(mysqli_query($con, "SELECT SUM(montant_total) FROM vente"));
$total_paye    = mysqli_fetch_row(mysqli_query($con, "SELECT SUM(montant_paye) FROM vente"));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des ventes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 4px; }
        .sous-titre { text-align: center; color: #666; margin-bottom: 16px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1a73e8; color: white; padding: 8px; text-align: left; font-size: 11px; }
        td { padding: 7px 8px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) td { background: #f5f5f5; }
        .totaux { margin-top: 12px; text-align: right; font-size: 12px; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #999; }
    </style>
</head>
<body>
<h2>OPTI CLOUD — Liste des ventes</h2>
<div class="sous-titre">Imprimé le <?php echo date('d/m/Y à H:i'); ?></div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Montant total</th>
            <th>Montant payé</th>
            <th>Reste</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $labels = array('paye'=>'Payé','partiel'=>'Partiel','impaye'=>'Impayé');
    while($row = mysqli_fetch_assoc($liste)):
        $reste = $row['montant_total'] - $row['montant_paye'];
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['patient_nom']); ?></td>
        <td><?php echo $row['date_vente']; ?></td>
        <td><?php echo number_format($row['montant_total'],2); ?> DH</td>
        <td><?php echo number_format($row['montant_paye'],2); ?> DH</td>
        <td><?php echo number_format($reste,2); ?> DH</td>
        <td><?php echo $labels[$row['statut']]; ?></td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<div class="totaux">
    <strong>Total général : <?php echo number_format($total_general[0],2); ?> DH</strong> &nbsp;|&nbsp;
    <strong>Total payé : <?php echo number_format($total_paye[0],2); ?> DH</strong> &nbsp;|&nbsp;
    <strong>Reste : <?php echo number_format($total_general[0]-$total_paye[0],2); ?> DH</strong>
</div>
<div class="footer">OPTI CLOUD &copy; <?php echo date('Y'); ?></div>
<script>window.onload = function(){ window.print(); }</script>
</body>
</html>