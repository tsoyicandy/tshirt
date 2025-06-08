<?php
session_start();
require_once '../../client/src/php/db/db.php';
require_once '../src/php/classes/AdminDAO.php';
require_once '../src/php/classes/Admin.php';
$pdo = getPDO();
$adminDAO = new AdminDAO($pdo);

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $motDePasse = $_POST['mot_de_passe'] ?? '';

    // Recherche de l'admin dans la base
    $admin = $adminDAO->findByCredentials($email, $motDePasse);

    if ($admin) {
        $_SESSION['is_admin'] = true;
        $_SESSION['id_admin'] = $admin->__get('id_admin');
        $_SESSION['email_admin'] = $admin->__get('email');
        header("Location: ../index.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Connexion administrateur</h2>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <a href="../../index.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
</body>
</html>