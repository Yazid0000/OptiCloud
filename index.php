<?php require("auth.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>OPTI CLOUD - Gestion Cabinet Opticien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f0f4f8; }
        .navbar-brand { font-weight: 800; letter-spacing: 1px; }
        .card-module { transition: transform .2s, box-shadow .2s; border: none; border-radius: 16px; }
        .card-module:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,.12); }
        .icon-box { font-size: 2.8rem; }
        .hero { background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); color: white; border-radius: 20px; padding: 40px; margin-bottom: 40px; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-eyeglasses me-2"></i>OPTI CLOUD
        </a>
        <span class="text-white-50 small d-none d-md-inline">Système de gestion cabinet opticien</span>
<div class="d-flex align-items-center gap-2">
    <span class="text-white-50 small">
        <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['user_nom']) ?>
    </span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
    </a>
</div>
    </div>
</nav>

<div class="container mt-4">

    <!-- Hero -->
    <div class="hero shadow">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-2"><i class="bi bi-eyeglasses me-2"></i>Bienvenue sur OPTI CLOUD</h1>
                <p class="lead mb-0 opacity-75">Gérez votre cabinet d'opticien : stock, marques, verres, montures, lentilles et opticiens.</p>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <i class="bi bi-eye" style="font-size:6rem; opacity:.3;"></i>
            </div>
        </div>
    </div>

    <!-- Modules -->
    <div class="row g-4">

        <!-- Catégorie -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-primary mb-3"><i class="bi bi-grid-3x3-gap-fill"></i></div>
                    <h5 class="fw-bold">Catégories</h5>
                    <p class="text-muted small">Gérer les catégories de produits (lunettes, lentilles, accessoires…)</p>
                    <a href="categorie/categorie_list.php" class="btn btn-primary btn-sm mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Fournisseur -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-success mb-3"><i class="bi bi-truck"></i></div>
                    <h5 class="fw-bold">Fournisseurs</h5>
                    <p class="text-muted small">Gérer les fournisseurs : coordonnées, responsables, villes…</p>
                    <a href="fournisseur/fournisseur_list.php" class="btn btn-success btn-sm mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Marque -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-warning mb-3"><i class="bi bi-award-fill"></i></div>
                    <h5 class="fw-bold">Marques</h5>
                    <p class="text-muted small">Gérer les marques : Ray-Ban, Essilor, Zeiss, Hoya…</p>
                    <a href="marque/marque_list.php" class="btn btn-warning btn-sm mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Verre -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-info mb-3"><i class="bi bi-circle-half"></i></div>
                    <h5 class="fw-bold">Verres</h5>
                    <p class="text-muted small">Gérer les verres optiques : type, indice, traitement, prix…</p>
                    <a href="verre/verre_list.php" class="btn btn-info btn-sm mt-2 text-white">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Monture -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-danger mb-3"><i class="bi bi-eyeglasses"></i></div>
                    <h5 class="fw-bold">Montures</h5>
                    <p class="text-muted small">Gérer le stock de montures : modèles, couleurs, matériaux, prix…</p>
                    <a href="monture/monture_list.php" class="btn btn-danger btn-sm mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Lentille -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box mb-3" style="color:#6f42c1;"><i class="bi bi-bullseye"></i></div>
                    <h5 class="fw-bold">Lentilles</h5>
                    <p class="text-muted small">Gérer les lentilles de contact : type, correction, matériau…</p>
                    <a href="lentille/lentille_list.php" class="btn btn-sm mt-2 text-white" style="background:#6f42c1;">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

        <!-- Opticien -->
        <div class="col-md-4 col-sm-6">
            <div class="card card-module shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box text-secondary mb-3"><i class="bi bi-shop"></i></div>
                    <h5 class="fw-bold">Opticiens</h5>
                    <p class="text-muted small">Gérer les opticiens partenaires : magasins, licences, statut…</p>
                    <a href="opticien/opticien_list.php" class="btn btn-secondary btn-sm mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Accéder
                    </a>
                </div>
            </div>
        </div>

    </div><!-- /row -->

    <footer class="text-center text-muted mt-5 pb-3 small">
        OPTI CLOUD &copy; <?php echo date('Y'); ?> — Système de gestion cabinet opticien
    </footer>
</div>

</body>
</html>
