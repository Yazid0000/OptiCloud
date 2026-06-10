<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Imprimer";
$page_breadcrumb = "Imprimer / <span>Liste</span>";

require("../layout.php");

$modules = array(
    'verre'       => array('label' => 'Verres',       'cols' => array('ref_verre','prix_verre','stock')),
    'monture'     => array('label' => 'Montures',     'cols' => array('ref_monture','prix_monture','stock')),
    'lentille'    => array('label' => 'Lentilles',    'cols' => array('ref_lentille','prix_lentille','stock')),
    'marque'      => array('label' => 'Marques',      'cols' => array('nom_marque')),
    'categorie'   => array('label' => 'Catégories',   'cols' => array('nom_categorie')),
    'fournisseur' => array('label' => 'Fournisseurs', 'cols' => array('nom_fournisseur','tel_fournisseur','email_fournisseur','ville_fournisseur')),
    'opticien'    => array('label' => 'Opticiens',    'cols' => array('nom_opticien','prenom_opticien','tel_opticien','email_opticien')),
);

$module_choisi = isset($_GET['module']) && array_key_exists($_GET['module'], $modules) ? $_GET['module'] : '';
$rows = [];
$total = 0;

if ($module_choisi) {
    $result = mysqli_query($con, "SELECT * FROM `$module_choisi` ORDER BY id");
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    $total = count($rows);
}
?>

<div class="card-dark" style="margin-bottom:16px;">
    <div class="card-header"><i class="bi bi-printer me-2"></i>Impression de liste</div>
    <div style="padding:16px;">
        <form method="GET" style="display:flex; align-items:center; gap:12px;">
            <select name="module" class="form-select form-dark"
                    style="width:220px; background:#1e2130; border:1px solid #2a2d3a; color:#e2e8f0; border-radius:7px; padding:6px 10px; font-size:13px;">
                <option value="">-- Choisir un module --</option>
                <?php foreach ($modules as $key => $m): ?>
                    <option value="<?php echo $key; ?>" <?php echo $module_choisi === $key ? 'selected' : ''; ?>>
                        <?php echo $m['label']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary-dark">
                <i class="bi bi-eye"></i> Afficher
            </button>
            <?php if ($module_choisi): ?>
                <button type="button" class="btn-secondary-dark" onclick="imprimerListe()">
                    <i class="bi bi-printer"></i> Imprimer
                </button>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php if ($module_choisi): ?>
<div class="card-dark" id="zone-impression">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <span><i class="bi bi-table me-2"></i>
            <?php echo $modules[$module_choisi]['label']; ?>
            <span style="color:#64748b; font-weight:400; font-size:12px; margin-left:8px;">
                <?php echo $total; ?> enregistrement<?php echo $total > 1 ? 's' : ''; ?>
            </span>
        </span>
        <span style="color:#64748b; font-size:12px;">
            <?php echo date('d/m/Y H:i'); ?>
        </span>
    </div>
    <div style="overflow-x:auto;">
        <table class="table-dark-custom" style="width:100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <?php foreach ($modules[$module_choisi]['cols'] as $col): ?>
                        <th><?php echo ucfirst(str_replace('_', ' ', $col)); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php if ($total === 0): ?>
                <tr><td colspan="<?php echo count($modules[$module_choisi]['cols']) + 1; ?>"
                        style="text-align:center; color:#475569; padding:30px;">
                    Aucun enregistrement trouvé
                </td></tr>
            <?php else: foreach ($rows as $i => $row): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <?php foreach ($modules[$module_choisi]['cols'] as $col): ?>
                        <td><?php echo htmlspecialchars($row[$col] ?? ''); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<script>
function imprimerListe() {
    var zone    = document.getElementById('zone-impression').innerHTML;
    var module  = "<?php echo htmlspecialchars($modules[$module_choisi]['label'] ?? ''); ?>";
    var fenetre = window.open('', '_blank');
    fenetre.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Impression - ` + module + `</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: Arial, sans-serif; font-size: 12px; color: #000; background: #fff; padding: 20px; }
                h2 { font-size: 16px; margin-bottom: 4px; }
                .entete { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; border-bottom: 2px solid #000; padding-bottom: 10px; }
                .entete-titre { font-size: 18px; font-weight: bold; }
                .entete-info  { font-size: 11px; color: #555; text-align: right; }
                table { width: 100%; border-collapse: collapse; margin-top: 8px; }
                th { background: #f0f0f0; border: 1px solid #ccc; padding: 7px 10px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px; }
                td { border: 1px solid #ddd; padding: 7px 10px; font-size: 12px; }
                tr:nth-child(even) td { background: #fafafa; }
                .card-header { display: none; }
                @media print { body { padding: 0; } }
            </style>
        </head>
        <body>
            <div class="entete">
                <div>
                    <div class="entete-titre">OPTI CLOUD</div>
                    <div style="font-size:12px; color:#555;">Liste : ` + module + `</div>
                </div>
                <div class="entete-info">
                    Imprimé le : <?php echo date('d/m/Y à H:i'); ?><br>
                    <?php echo $total; ?> enregistrement<?php echo $total > 1 ? 's' : ''; ?>
                </div>
            </div>
            ` + zone + `
        </body>
        </html>
    `);
    fenetre.document.close();
    fenetre.focus();
    setTimeout(function() { fenetre.print(); }, 400);
}
</script>

<?php require("../layout_end.php"); ?>