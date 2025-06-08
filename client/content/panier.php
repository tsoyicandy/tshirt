<?php
include '../src/php/utils/header.php';
if (!isset($_SESSION['id_client'])) {
    header('Location: login.php');
    exit;
}

require_once '../src/php/db/db.php';
require_once '../src/php/classes/CommandeDAO.php';
require_once '../src/php/classes/DetailCommandeDAO.php';
require_once '../src/php/classes/TshirtDAO.php';

// Fonction pour obtenir un PDO (si tu n'utilises pas encore getPDO() dans db.php)
$pdo = getPDO();

$pdo = getPDO();
$commandeDAO = new CommandeDAO($pdo);
$detailDAO = new DetailCommandeDAO($pdo);
$tshirtDAO = new TshirtDAO($pdo);

$idClient = $_SESSION['id_client'];
$commande = $commandeDAO->getCommandeEnCours($idClient);
$details = [];

if ($commande) {
    $commandeId = $commande->__get('id_commande');
    $details = $detailDAO->getDetailsByCommande($commandeId);
}

// Supprimer un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_detail'])) {
    $detailDAO->delete((int)$_POST['delete_detail']);
    header("Location: panier.php");
    exit;
}
// Valider la commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider_commande'])) {
    $commande->__set('statut', 'validee');
    $commande->__set('date_commande', date('Y-m-d'));
    $commandeDAO->update($commande);
    header("Location: panier.php?success=1");
    exit;
}


?>

<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Votre panier</h2>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Votre commande a bien été validée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php endif; ?>


    <?php if (!$commande || empty($details)): ?>
        <div class="alert alert-info">Votre panier est vide.</div>
    <?php else: ?>
    <?php if ($commande->__get('statut') === 'en attente'): ?>
        <form method="post">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>T-shirt</th>
                        <th>Taille</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    foreach ($details as $detail):
                        $tshirt = $tshirtDAO->findById($detail->__get('id_tshirt'));
                        $taille = $detail->__get('id_taille');
                        $qte = $detail->__get('quantite');
                        $prix = $detail->__get('prix_unitaire');
                        $totalLigne = $qte * $prix;
                        $total += $totalLigne;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($tshirt->__get('nom')) ?></td>
                            <td><?= htmlspecialchars($taille) ?></td>
                            <td><?= $qte ?></td>
                            <td><?= number_format($prix, 2) ?> €</td>
                            <td><?= number_format($totalLigne, 2) ?> €</td>
                            <td>
                                <button type="submit" name="delete_detail" value="<?= $detail->__get('id_detail') ?>" class="btn btn-outline-danger btn-sm">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th colspan="2"><?= number_format($total, 2) ?> €</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" name="valider_commande" class="btn btn-success">Valider la commande</button>
            </div>
        </form>
        <?php endif; ?>

    <?php endif; ?>
    <?php if ($commande && $commande->__get('statut') === 'validee'): ?>
        <div class="alert alert-success mt-3">
            Cette commande a été validée et ne peut plus être modifiée.
        </div>
    <?php endif; ?>


    <div class="mt-4">
        <a href="tshirts.php" class="btn btn-outline-secondary">← Retour aux T-shirts</a>
    </div>
</div>
</body>
<?php include '../src/php/utils/footer.php'; ?>
