<?php
require_once '../src/php/db/db.php';
require_once '../src/php/classes/ClientDAO.php';
include '../src/php/utils/header.php';
$pdo = getPDO();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDO();
    $dao = new ClientDAO($pdo);
    $client = $dao->findByEmail($_POST['email']);

    if ($client && $client->__get('motdepasse') === $_POST['motdepasse']) {
        $_SESSION['id_client'] = $client->__get('id_client');
        header('Location: ../../index.php');
        exit;
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}

?>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body, html {
            height: 100%;
            background: linear-gradient(to right, #667eea, #764ba2);
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            margin-top: 8%;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center mb-4">Connexion</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>
        <div class="mb-3">
            <label for="motdepasse" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>

            <a href="../../admin/index.php" class="">Gestion?</a>

    </form>
</div>

</body>
<?php include '../src/php/utils/footer.php'; ?>
