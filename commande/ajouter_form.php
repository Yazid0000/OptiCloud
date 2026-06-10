<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Nouvelle commande";
$page_breadcrumb = "Fournisseurs / Commandes / <span>Ajouter</span>";

$erreur = "";
$succes = "";

$fournisseurs = mysqli_query($con, "SELECT id, nom_fournisseur FROM fournisseur ORDER BY nom_fournisseur");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fournisseur_id = isset($_POST['fournisseur_id']) ? intval($_POST['fournisseur_id']) : 0;
    $date_commande  = isset($_POST['date_commande'])  ? trim($_POST['date_commande'])    : '';
    $statut         = isset($_POST['statut'])         ? trim($_POST['statut'])           : 'en_attente';
    $note           = isset($_POST['note'])           ? trim($_POST['note'])             : '';
    $types          = isset($_POST['type_produit'])   ? $_POST['type_produit']           : array();
    $produit_ids    = isset($_POST['produit_id'])     ? $_POST['produit_id']             : array();
    $quantites      = isset($_POST['quantite'])       ? $_POST['quantite']               : array();
    $prix_units     = isset($_POST['prix_unitaire'])  ? $_POST['prix_unitaire']          : array();

    if ($fournisseur_id === 0 || $date_commande === '' || empty($types)) {
        $erreur = "Fournisseur, date et au moins un produit sont obligatoires.";
    } else {
        $montant_total = 0;
        foreach ($types as $k => $type) {
            $montant_total += floatval($prix_units[$k]) * intval($quantites[$k]);
        }
        $note_s   = mysqli_real_escape_string($con, $note);
        $statut_s = mysqli_real_escape_string($con, $statut);
        mysqli_query($con, "INSERT INTO commande (fournisseur_id, date_commande, statut, montant_total, note)
                            VALUES ($fournisseur_id, '$date_commande', '$statut_s', $montant_total, '$note_s')");
        $commande_id = mysqli_insert_id($con);

        foreach ($types as $k => $type) {
            $pid    = intval($produit_ids[$k]);
            $qte    = intval($quantites[$k]);
            $prix   = floatval($prix_units[$k]);
            $type_s = mysqli_real_escape_string($con, $type);
            mysqli_query($con, "INSERT INTO commande_detail (commande_id, type_produit, produit_id, quantite, prix_unitaire)
                                VALUES ($commande_id, '$type_s', $pid, $qte, $prix)");
            // Si commande déjà reçue, incrémenter le stock
            if ($statut === 'recue') {
                if ($type === 'monture') {
                    mysqli_query($con, "UPDATE monture SET stock = stock + $qte WHERE id = $pid");
                } elseif ($type === 'verre') {
                    mysqli_query($con, "UPDATE verre SET stock = stock + $qte WHERE id = $pid");
                } elseif ($type === 'lentille') {
                    mysqli_query($con, "UPDATE lentille SET stock = stock + $qte WHERE id = $pid");
                }
            }
        }
        $succes = "Commande enregistrée avec succès. Montant total : ".number_format($montant_total, 2)." DH";
    }
}

require("../layout.php");
?>

<div style="max-width:800px;">
    <div class="card-dark">
        <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Nouvelle commande fournisseur</div>
        <div style="padding:20px;">

            <?php if ($erreur): ?>
                <div class="alert-dark-danger mb-3"><?php echo $erreur; ?></div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert-dark-success mb-3"><?php echo $succes; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-dark" id="commandeForm">
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
                    <div class="mb-3">
                        <label class="form-label">Fournisseur *</label>
                        <select name="fournisseur_id" class="form-select">
                            <option value="0">-- Choisir --</option>
                            <?php while($f = mysqli_fetch_assoc($fournisseurs)): ?>
                            <option value="<?php echo $f['id']; ?>"><?php echo htmlspecialchars($f['nom_fournisseur']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date *</label>
                        <input type="date" name="date_commande" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="en_attente">En attente</option>
                            <option value="recue">Reçue</option>
                            <option value="annulee">Annulée</option>
                        </select>
                    </div>
                </div>

                <!-- LIGNES PRODUITS -->
                <div style="margin-bottom:12px;">
                    <div style="color:#94a3b8; font-size:13px; font-weight:600; margin-bottom:10px;">
                        <i class="bi bi-box-seam me-1"></i> Produits à commander
                    </div>
                    <div id="lignes">
                        <div class="ligne-produit" style="display:grid; grid-template-columns:2fr 3fr 1fr 2fr auto; gap:8px; margin-bottom:8px; align-items:end;">
                            <div>
                                <label class="form-label">Type</label>
                                <select name="type_produit[]" class="form-select type-select" onchange="updateProduits(this)">
                                    <option value="">-- Type --</option>
                                    <option value="monture">Monture</option>
                                    <option value="verre">Verre</option>
                                    <option value="lentille">Lentille</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Produit</label>
                                <select name="produit_id[]" class="form-select produit-select">
                                    <option value="0">-- Choisir --</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Qté</label>
                                <input type="number" name="quantite[]" class="form-control qte-input" value="1" min="1" onchange="updateTotal()">
                            </div>
                            <div>
                                <label class="form-label">Prix unitaire (DH)</label>
                                <input type="number" step="0.01" name="prix_unitaire[]" class="form-control prix-input" value="0" onchange="updateTotal()">
                            </div>
                            <div>
                                <label class="form-label">&nbsp;</label>
                                <button type="button" onclick="supprimerLigne(this)" class="btn-danger-dark" style="width:36px; justify-content:center;">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="ajouterLigne()" class="btn-secondary-dark" style="margin-top:4px;">
                        <i class="bi bi-plus"></i> Ajouter un produit
                    </button>
                </div>

                <!-- TOTAL -->
                <div style="background:#1e2130; border-radius:8px; padding:14px; margin-bottom:16px; text-align:right;">
                    <span style="color:#64748b; font-size:13px;">Total : </span>
                    <span id="total_display" style="color:#e2e8f0; font-size:20px; font-weight:600;">0.00 DH</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Remarques..."></textarea>
                </div>

                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-dark">
                        <i class="bi bi-check-lg"></i> Enregistrer la commande
                    </button>
                    <a href="<?php echo $base_url; ?>commande/commande_list.php" class="btn-secondary-dark">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var produits = {
    monture:  <?php
        $arr = array();
        $res = mysqli_query($con, "SELECT id, ref_monture AS ref, prix_monture AS prix FROM monture ORDER BY ref_monture");
        while($r = mysqli_fetch_assoc($res)) $arr[] = $r;
        echo json_encode($arr);
    ?>,
    verre:    <?php
        $arr = array();
        $res = mysqli_query($con, "SELECT id, ref_verre AS ref, prix_verre AS prix FROM verre ORDER BY ref_verre");
        while($r = mysqli_fetch_assoc($res)) $arr[] = $r;
        echo json_encode($arr);
    ?>,
    lentille: <?php
        $arr = array();
        $res = mysqli_query($con, "SELECT id, ref_lentille AS ref, prix_lentille AS prix FROM lentille ORDER BY ref_lentille");
        while($r = mysqli_fetch_assoc($res)) $arr[] = $r;
        echo json_encode($arr);
    ?>
};

function updateProduits(sel) {
    var type = sel.value;
    var ligne = sel.closest('.ligne-produit');
    var prodSel = ligne.querySelector('.produit-select');
    var prixInput = ligne.querySelector('.prix-input');
    prodSel.innerHTML = '<option value="0">-- Choisir --</option>';
    prixInput.value = 0;
    if (type && produits[type]) {
        produits[type].forEach(function(p) {
            var opt = document.createElement('option');
            opt.value = p.id;
            opt.text  = p.ref;
            opt.setAttribute('data-prix', p.prix);
            prodSel.appendChild(opt);
        });
    }
    updateTotal();
}

function updatePrix(sel) {
    var opt = sel.options[sel.selectedIndex];
    var prix = opt.getAttribute('data-prix') || 0;
    var ligne = sel.closest('.ligne-produit');
    ligne.querySelector('.prix-input').value = prix;
    updateTotal();
}

function updateTotal() {
    var total = 0;
    document.querySelectorAll('.ligne-produit').forEach(function(ligne) {
        var qte  = parseFloat(ligne.querySelector('.qte-input').value)  || 0;
        var prix = parseFloat(ligne.querySelector('.prix-input').value) || 0;
        total += qte * prix;
    });
    document.getElementById('total_display').textContent = total.toFixed(2) + ' DH';
}

function ajouterLigne() {
    var template = document.querySelector('.ligne-produit').cloneNode(true);
    template.querySelectorAll('select')[0].value = '';
    template.querySelectorAll('select')[1].innerHTML = '<option value="0">-- Choisir --</option>';
    template.querySelector('.qte-input').value  = 1;
    template.querySelector('.prix-input').value = 0;
    template.querySelectorAll('select')[0].onchange = function() { updateProduits(this); };
    template.querySelectorAll('select')[1].onchange = function() { updatePrix(this); };
    template.querySelector('.qte-input').onchange  = updateTotal;
    template.querySelector('.prix-input').onchange = updateTotal;
    document.getElementById('lignes').appendChild(template);
}

function supprimerLigne(btn) {
    var lignes = document.querySelectorAll('.ligne-produit');
    if (lignes.length > 1) {
        btn.closest('.ligne-produit').remove();
        updateTotal();
    }
}
</script>

<?php require("../layout_end.php"); ?>