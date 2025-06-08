<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: content/login.php');
    exit;
}

require_once '../client/src/php/db/db.php';
require_once '../client/src/php/classes/TshirtDAO.php';
require_once '../client/src/php/classes/Tshirt.php';

$pdo = getPDO();
$dao = new TshirtDAO($pdo);
$tshirts = $dao->findAll();
?>

<head>
    <meta charset="UTF-8">
    <title>Administration - T-shirts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Gestion des T-shirts</h2>

    <a href="content/ajouter.php" class="btn btn-primary mb-3">➕ Ajouter un nouveau T-shirt</a>

    <?php if (empty($tshirts)): ?>
        <div class="alert alert-warning">Aucun t-shirt enregistré.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tshirts as $t): ?>
                <tr>
                    <td><?= $t->__get('id_tshirt') ?></td>
                    <td><?= htmlspecialchars($t->__get('nom')) ?></td>
                    <td><?= number_format($t->__get('prix'), 2) ?> €</td>
                    <td><?= htmlspecialchars($t->__get('categorie') ?? '') ?></td>
                    <td>
                        <a href="content/modifier.php?id=<?= $t->__get('id_tshirt') ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <a href="content/supprimer.php?id=<?= $t->__get('id_tshirt') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce t-shirt ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="../index.php" class="btn btn-outline-secondary mt-4">← Retour au site</a>
</div>
</body>

