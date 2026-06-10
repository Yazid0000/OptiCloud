<?php
require("../auth.php");
require("../connexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    // Récupérer le montant et la vente avant suppression
    $res = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM paiement WHERE id = $id"));
    if ($res) {
        $vente_id = $res['vente_id'];
        $montant  = $res['montant'];
        mysqli_query($con, "DELETE FROM paiement WHERE id = $id");

        // Recalculer montant_paye et statut
        $res_v = mysqli_fetch_assoc(mysqli_query($con, "SELECT montant_total, montant_paye FROM vente WHERE id = $vente_id"));
        $nouveau_paye = $res_v['montant_paye'] - $montant;
        if ($nouveau_paye < 0) $nouveau_paye = 0;
        if ($nouveau_paye >= $res_v['montant_total']) {
            $statut = 'paye';
        } elseif ($nouveau_paye > 0) {
            $statut = 'partiel';
        } else {
            $statut = 'impaye';
        }
        mysqli_query($con, "UPDATE vente SET montant_paye = $nouveau_paye, statut = '$statut' WHERE id = $vente_id");
    }
}
header("Location: /www/OPTI_CLOUD_PHP5/paiement/paiement_list.php");
exit();
?>