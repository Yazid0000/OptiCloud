<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir  = basename(dirname($_SERVER['PHP_SELF']));
$base_url = '/www/OPTI_CLOUD_PHP5/';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OPTI CLOUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #0f1117; color: #e2e8f0; display: flex; min-height: 100vh; }
        #sidebar { width: 230px; background: #161820; border-right: 1px solid #2a2d3a; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100; overflow: hidden; }
        .sidebar-logo { padding: 16px; border-bottom: 1px solid #2a2d3a; display: flex; align-items: center; gap: 10px; white-space: nowrap; }
        .logo-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .logo-icon i { font-size: 18px; color: #fff; }
        .logo-text { font-size: 14px; font-weight: 600; color: #e2e8f0; }
        .logo-sub  { font-size: 10px; color: #64748b; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 8px 0; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #2a2d3a; border-radius: 2px; }
        .nav-section-title { font-size: 10px; font-weight: 600; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; padding: 10px 16px 4px; white-space: nowrap; }
        .nav-item { display: flex; align-items: center; gap: 9px; padding: 8px 16px; font-size: 13px; color: #94a3b8; cursor: pointer; text-decoration: none; white-space: nowrap; transition: background .15s, color .15s; }
        .nav-item:hover { background: #1e2130; color: #e2e8f0; text-decoration: none; }
        .nav-item.active { background: #1e3a5f; color: #60a5fa; }
        .nav-item i { font-size: 16px; width: 18px; flex-shrink: 0; }
        .sidebar-user { padding: 12px 16px; border-top: 1px solid #2a2d3a; display: flex; align-items: center; gap: 9px; white-space: nowrap; }
        .user-avatar { width: 30px; height: 30px; border-radius: 50%; background: #1e3a5f; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; color: #60a5fa; flex-shrink: 0; }
        .user-name { font-size: 12px; color: #e2e8f0; font-weight: 500; }
        .user-role { font-size: 10px; color: #64748b; }
        #topbar { position: fixed; top: 0; left: 230px; right: 0; height: 54px; background: #161820; border-bottom: 1px solid #2a2d3a; display: flex; align-items: center; padding: 0 20px; gap: 12px; z-index: 99; }
        .topbar-title { font-size: 15px; font-weight: 600; color: #e2e8f0; flex: 1; }
        .topbar-breadcrumb { font-size: 11px; color: #475569; }
        .topbar-breadcrumb span { color: #60a5fa; }
        .btn-topbar { background: #1e2130; border: 1px solid #2a2d3a; border-radius: 7px; padding: 6px 14px; font-size: 12px; color: #94a3b8; cursor: pointer; display: flex; align-items: center; gap: 6px; text-decoration: none; transition: background .15s; }
        .btn-topbar:hover { background: #252836; color: #e2e8f0; text-decoration: none; }
        .btn-topbar.primary { background: #2563eb; border-color: #2563eb; color: #fff; }
        .btn-topbar.primary:hover { background: #1d4ed8; color: #fff; }
        #main { margin-left: 230px; margin-top: 54px; padding: 24px; min-height: calc(100vh - 54px); box-sizing: border-box; width: calc(100% - 230px); }
        .card-dark { background: #161820; border: 1px solid #2a2d3a; border-radius: 10px; }
        .card-dark .card-header { background: transparent; border-bottom: 1px solid #2a2d3a; padding: 14px 18px; font-size: 14px; font-weight: 600; color: #e2e8f0; }
        .stat-card { background: #161820; border: 1px solid #2a2d3a; border-radius: 10px; padding: 16px; }
        .stat-label { font-size: 11px; color: #64748b; margin-bottom: 6px; }
        .stat-value { font-size: 24px; font-weight: 600; color: #e2e8f0; }
        .stat-sub { font-size: 11px; color: #22c55e; margin-top: 3px; }
        .stat-sub.warn { color: #fb923c; }
        .table-dark-custom { width: 100%; border-collapse: collapse; }
        .table-dark-custom th { background: #1e2130; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 10px 14px; border-bottom: 1px solid #2a2d3a; font-weight: 500; }
        .table-dark-custom td { padding: 11px 14px; border-bottom: 1px solid #1a1d29; font-size: 13px; color: #94a3b8; vertical-align: middle; }
        .table-dark-custom tr:last-child td { border-bottom: none; }
        .table-dark-custom tr:hover td { background: #1e2130; }
        .table-dark-custom td.primary-col { color: #e2e8f0; font-weight: 500; }
        .badge-green  { background: #14532d; color: #4ade80;  padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .badge-red    { background: #450a0a; color: #f87171;  padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .badge-blue   { background: #1e3a5f; color: #60a5fa;  padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .badge-orange { background: #431407; color: #fb923c;  padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .badge-gray   { background: #1e2130; color: #94a3b8;  padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .form-dark .form-label { color: #94a3b8; font-size: 13px; margin-bottom: 5px; }
        .form-dark .form-control, .form-dark .form-select { background: #1e2130; border: 1px solid #2a2d3a; color: #e2e8f0; border-radius: 7px; font-size: 13px; }
        .form-dark .form-control:focus, .form-dark .form-select:focus { background: #1e2130; border-color: #2563eb; color: #e2e8f0; box-shadow: 0 0 0 3px rgba(37,99,235,0.2); }
        .form-dark .form-control::placeholder { color: #475569; }
        .form-dark select option { background: #1e2130; }
        .alert-dark-danger  { background: #450a0a; border: 1px solid #7f1d1d; color: #f87171; border-radius: 8px; padding: 12px 16px; font-size: 13px; }
        .alert-dark-success { background: #14532d; border: 1px solid #166534; color: #4ade80; border-radius: 8px; padding: 12px 16px; font-size: 13px; }
        .btn-primary-dark { background: #2563eb; border: none; color: #fff; border-radius: 7px; padding: 8px 16px; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-primary-dark:hover { background: #1d4ed8; color: #fff; text-decoration: none; }
        .btn-danger-dark { background: #7f1d1d; border: none; color: #f87171; border-radius: 7px; padding: 8px 16px; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-danger-dark:hover { background: #991b1b; color: #fca5a5; text-decoration: none; }
        .btn-secondary-dark { background: #1e2130; border: 1px solid #2a2d3a; color: #94a3b8; border-radius: 7px; padding: 8px 16px; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-secondary-dark:hover { background: #252836; color: #e2e8f0; text-decoration: none; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon"><i class="bi bi-eyeglasses"></i></div>
        <div>
            <div class="logo-text">OPTI CLOUD</div>
            <div class="logo-sub">Cabinet opticien</div>
        </div>
    </div>
    <div class="sidebar-nav">

        <div class="nav-section-title">Principal</div>
        <a href="<?php echo $base_url; ?>index.php"
           class="nav-item <?php echo $current_page=='index.php' ? 'active' : ''; ?>">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>

        <div class="nav-section-title">Patients</div>
        <a href="<?php echo $base_url; ?>patient/patient_list.php"
           class="nav-item <?php echo $current_dir=='patient' ? 'active' : ''; ?>">
            <i class="bi bi-people"></i> Patients
        </a>
        <a href="<?php echo $base_url; ?>rendezvous/rendezvous_list.php"
           class="nav-item <?php echo $current_dir=='rendezvous' ? 'active' : ''; ?>">
            <i class="bi bi-calendar-check"></i> Rendez-vous
        </a>
        <a href="<?php echo $base_url; ?>prescription/prescription_list.php"
           class="nav-item <?php echo $current_dir=='prescription' ? 'active' : ''; ?>">
            <i class="bi bi-file-medical"></i> Prescriptions
        </a>

        <div class="nav-section-title">Ventes</div>
        <a href="<?php echo $base_url; ?>vente/vente_list.php"
           class="nav-item <?php echo $current_dir=='vente' ? 'active' : ''; ?>">
            <i class="bi bi-cart3"></i> Ventes
        </a>
        <a href="<?php echo $base_url; ?>paiement/paiement_list.php"
           class="nav-item <?php echo $current_dir=='paiement' ? 'active' : ''; ?>">
            <i class="bi bi-cash-coin"></i> Paiements
        </a>

        <div class="nav-section-title">Stock</div>
        <a href="<?php echo $base_url; ?>monture/monture_list.php"
           class="nav-item <?php echo $current_dir=='monture' ? 'active' : ''; ?>">
            <i class="bi bi-eyeglasses"></i> Montures
        </a>
        <a href="<?php echo $base_url; ?>verre/verre_list.php"
           class="nav-item <?php echo $current_dir=='verre' ? 'active' : ''; ?>">
            <i class="bi bi-circle-half"></i> Verres
        </a>
        <a href="<?php echo $base_url; ?>lentille/lentille_list.php"
           class="nav-item <?php echo $current_dir=='lentille' ? 'active' : ''; ?>">
            <i class="bi bi-bullseye"></i> Lentilles
        </a>

        <div class="nav-section-title">Fournisseurs</div>
        <a href="<?php echo $base_url; ?>fournisseur/fournisseur_list.php"
           class="nav-item <?php echo $current_dir=='fournisseur' ? 'active' : ''; ?>">
            <i class="bi bi-truck"></i> Fournisseurs
        </a>
        <a href="<?php echo $base_url; ?>commande/commande_list.php"
           class="nav-item <?php echo $current_dir=='commande' ? 'active' : ''; ?>">
            <i class="bi bi-box-seam"></i> Commandes
        </a>
        <div class="nav-section-title">Impression</div>
        <a href="<?php echo $base_url; ?>impression/impression.php"
           class="nav-item <?php echo $current_dir=='impression' ? 'active' : ''; ?>">
            <i class="bi bi-printer"></i> Imprimer
        </a>

        <div class="nav-section-title">Administration</div>
        <a href="<?php echo $base_url; ?>utilisateur/utilisateur_list.php"
           class="nav-item <?php echo $current_dir=='utilisateur' ? 'active' : ''; ?>">
            <i class="bi bi-person-gear"></i> Utilisateurs
        </a>
        <a href="<?php echo $base_url; ?>categorie/categorie_list.php"
           class="nav-item <?php echo $current_dir=='categorie' ? 'active' : ''; ?>">
            <i class="bi bi-tags"></i> Catégories
        </a>
        <a href="<?php echo $base_url; ?>marque/marque_list.php"
           class="nav-item <?php echo $current_dir=='marque' ? 'active' : ''; ?>">
            <i class="bi bi-bookmark"></i> Marques
        </a>

    </div>
    <div class="sidebar-user">
        <div class="user-avatar"><?php echo isset($_SESSION['user_nom']) ? strtoupper(substr($_SESSION['user_nom'],0,2)) : 'AD'; ?></div>
        <div style="flex:1; min-width:0;">
            <div class="user-name"><?php echo isset($_SESSION['user_nom']) ? htmlspecialchars($_SESSION['user_nom']) : 'Admin'; ?></div>
            <div class="user-role"><?php echo isset($_SESSION['user_role']) ? ucfirst($_SESSION['user_role']) : ''; ?></div>
        </div>
        <a href="<?php echo $base_url; ?>logout.php" style="color:#475569; font-size:16px;">
            <i class="bi bi-box-arrow-right"></i>
        </a>
    </div>
</div>

<!-- TOPBAR -->
<div id="topbar">
    <div style="flex:1;">
        <div class="topbar-title"><?php echo isset($page_title) ? $page_title : 'OPTI CLOUD'; ?></div>
        <div class="topbar-breadcrumb"><?php echo isset($page_breadcrumb) ? $page_breadcrumb : ''; ?></div>
    </div>
    <div style="display:flex; gap:8px; align-items:center;">
        <?php if(isset($btn_action)): ?>
            <a href="<?php echo $base_url; ?><?php echo $btn_action_url; ?>" class="btn-topbar primary">
                <i class="bi bi-plus-lg"></i> <?php echo $btn_action; ?>
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- MAIN -->
<div id="main">