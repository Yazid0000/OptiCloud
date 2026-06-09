<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("connexion.php");

    $login    = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($login === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $login_safe = mysqli_real_escape_string($con, $login);
        $sql = "SELECT * FROM utilisateurs WHERE login = '$login_safe' AND actif = 1 LIMIT 1";
        $res = mysqli_query($con, $sql);

        if ($res && mysqli_num_rows($res) === 1) {
            $user = mysqli_fetch_assoc($res);
            if (md5($password) === $user['mot_de_passe']) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_nom']  = $user['nom'];
                $_SESSION['user_role'] = $user['role'];
                header("Location: index.php");
                exit();
            } else {
                $erreur = "Identifiant ou mot de passe incorrect.";
            }
        } else {
            $erreur = "Identifiant ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>OPTI CLOUD — Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-header {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            border-radius: 20px 20px 0 0;
            padding: 36px 32px 28px;
            text-align: center;
            color: white;
        }
        .login-header .icon { font-size: 3.5rem; }
        .login-body {
            padding: 32px;
            background: white;
            border-radius: 0 0 20px 20px;
        }
        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 3px rgba(26,115,232,0.15);
        }
        .btn-login {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
        }
        .btn-login:hover { opacity: 0.88; }
        .input-group-text {
            background: #f0f4f8;
            border-right: none;
        }
        .form-control { border-left: none; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="icon"><i class="bi bi-eyeglasses"></i></div>
        <h4 class="fw-bold mt-2 mb-1">OPTI CLOUD</h4>
        <p class="mb-0 opacity-75 small">Gestion cabinet opticien</p>
    </div>
    <div class="login-body">
        <h5 class="fw-semibold text-center mb-4 text-dark">Connexion</h5>

        <?php if ($erreur != ""): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?php echo htmlspecialchars($erreur); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Identifiant</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill text-primary"></i></span>
                    <input type="text" name="login" class="form-control"
                           placeholder="Votre identifiant"
                           value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>"
                           autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill text-primary"></i></span>
                    <input type="password" name="password" class="form-control"
                           placeholder="Votre mot de passe">
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100 text-white">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </button>
        </form>

        <p class="text-center text-muted small mt-4 mb-0">
            OPTI CLOUD &copy; <?php echo date('Y'); ?>
        </p>
    </div>
</div>

</body>
</html>