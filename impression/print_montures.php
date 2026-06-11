<?php
require("../connexion.php");
$liste = mysqli_query($con, "SELECT m.*, c.nom_categorie, ma.nom_marque
    FROM monture m
    LEFT JOIN categorie c ON c.id = m.id_categorie
    LEFT JOIN marque ma ON ma.id = m.id_marque
    ORDER BY m.ref_monture");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Stock montures</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 4px; }
        .sous-titre { text-align: center; color: #666; margin-bottom: 16px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1a73e8; color: white; padding: 8px; text-align: left; font-size: 11px; }
        td { padding: 7px 8px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) td { background: #f5f5f5; }
        .stock-faible { color: #e53e3e; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #999; }
    </style>
</head>
<body>
<h2>OPTI CLOUD — Stock montures</h2>
<div class="sous-titre">Imprimé le <?php echo date('d/m/Y à H:i'); ?></div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Référence</th>
            <th>Marque</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($liste)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['ref_monture']); ?></td>
        <td><?php echo htmlspecialchars($row['nom_marque']); ?></td>
        <td><?php echo htmlspecialchars($row['nom_categorie']); ?></td>
        <td><?php echo number_format($row['prix_monture'],2); ?> DH</td>
        <td class="<?php echo $row['stock'] < 5 ? 'stock-faible' : ''; ?>">
            <?php echo $row['stock']; ?>
            <?php echo $row['stock'] < 5 ? ' ⚠' : ''; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<div class="footer">OPTI CLOUD &copy; <?php echo date('Y'); ?></div>
<script>window.onload = function(){ window.print(); }</script>
</body>
</html>