<?php
require("../auth.php");
require("../connexion.php");

$page_title      = "Impression";
$page_breadcrumb = "Impression / <span>Choisir un module</span>";

require("../layout.php");
?>

<div style="max-width:900px;">

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">

        <!-- Patients -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-people" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Patients</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de tous les patients</div>
            <a href="<?php echo $base_url; ?>impression/print_patients.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Rendez-vous -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-calendar-check" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Rendez-vous</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de tous les rendez-vous</div>
            <a href="<?php echo $base_url; ?>impression/print_rendezvous.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Prescriptions -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-file-medical" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Prescriptions</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de toutes les prescriptions</div>
            <a href="<?php echo $base_url; ?>impression/print_prescriptions.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Ventes -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-cart3" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Ventes</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de toutes les ventes</div>
            <a href="<?php echo $base_url; ?>impression/print_ventes.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Paiements -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-cash-coin" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Paiements</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de tous les paiements</div>
            <a href="<?php echo $base_url; ?>impression/print_paiements.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Montures -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-eyeglasses" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Montures</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste du stock montures</div>
            <a href="<?php echo $base_url; ?>impression/print_montures.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Verres -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-circle-half" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Verres</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste du stock verres</div>
            <a href="<?php echo $base_url; ?>impression/print_verres.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Lentilles -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-bullseye" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Lentilles</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste du stock lentilles</div>
            <a href="<?php echo $base_url; ?>impression/print_lentilles.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

        <!-- Fournisseurs -->
        <div class="card-dark" style="padding:20px; text-align:center;">
            <i class="bi bi-truck" style="font-size:2.5rem; color:#60a5fa;"></i>
            <div style="color:#e2e8f0; font-weight:600; margin:10px 0 4px;">Fournisseurs</div>
            <div style="color:#64748b; font-size:12px; margin-bottom:16px;">Liste de tous les fournisseurs</div>
            <a href="<?php echo $base_url; ?>impression/print_fournisseurs.php" target="_blank" class="btn-primary-dark" style="justify-content:center;">
                <i class="bi bi-printer"></i> Imprimer
            </a>
        </div>

    </div>
</div>

<?php require("../layout_end.php"); ?>