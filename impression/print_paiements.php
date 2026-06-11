<?php
require("../connexion.php");
$liste = mysqli_query($con, "SELECT p.*, CONCAT(pa.prenom,' ',pa.nom) AS patient_nom
    FROM paiement p
    JOIN vente v ON v.id = p.vente_id
    JOIN patient pa ON pa.id = v.patient_id
    ORDER BY p.date_paiement DESC");
$total = mysqli_fetch_row(mysqli_query($con, "SELECT SUM(montant) FROM paiement"));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des paiements</title>
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
<h2>OPTI CLOUD — Liste des paiements</h2>
<div class="sous-titre">Imprimé le <?php echo date('d/m/Y à H:i'); ?></div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Vente</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Mode</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($liste)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['patient_nom']); ?></td>
        <td>#<?php echo $row['vente_id']; ?></td>
        <td><?php echo $row['date_paiement']; ?></td>
        <td><?php echo number_format($row['montant'],2); ?> DH</td>
        <td><?php echo ucfirst($row['mode']); ?></td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<div class="totaux"><strong>Total encaissé : <?php echo number_format($total[0],2); ?> DH</strong></div>
<div class="footer">OPTI CLOUD &copy; <?php echo date('Y'); ?></div>
<script>window.onload = function(){ window.print(); }</script>
</body>
</html>