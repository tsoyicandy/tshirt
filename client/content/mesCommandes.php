<?php
session_start();
if (!isset($_SESSION['id_client'])) {
    header("Location: login.php");
    exit;
}

require_once '../src/php/db/db.php';
require_once '../src/php/classes/CommandeDAO.php';
require_once '../src/php/classes/DetailCommandeDAO.php';

$pdo = getPDO();
$idClient = $_SESSION['id_client'];

$commandeDAO = new CommandeDAO($pdo);
$detailDAO = new DetailCommandeDAO($pdo);

$commandes = $commandeDAO->getAllByClient($idClient);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Mes commandes</h2>

    <?php if (empty($commandes)): ?>
        <div class="alert alert-info">Vous n'avez passé aucune commande.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Montant total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($commandes as $commande):
                $details = $detailDAO->getDetailsByCommande($commande->__get('id_commande'));
                $total = 0;
                foreach ($details as $d) {
                    $total += $d->__get('quantite') * $d->__get('prix_unitaire');
                }
                ?>
                <tr>
                    <td><?= $commande->__get('id_commande') ?></td>
                    <td><?= htmlspecialchars($commande->__get('date_commande')) ?></td>
                    <td>
                            <span class="badge bg-<?= $commande->__get('statut') === 'validee' ? 'success' : 'warning' ?>">
                                <?= ucfirst($commande->__get('statut')) ?>
                            </span>
                    </td>
                    <td><?= number_format($total, 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="../../index.php" class="btn btn-outline-secondary mt-4">← Retour à l'accueil</a>
</div>
</body>
</html>
