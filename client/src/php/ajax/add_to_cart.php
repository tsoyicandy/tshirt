<?php
session_start();
require_once '../db/db.php';
require_once '../classes/CommandeDAO.php';
require_once '../classes/DetailCommandeDAO.php';
require_once '../classes/TshirtDAO.php';

header('Content-Type: application/json');

$pdo = getPDO();

if (!isset($_SESSION['id_client'])) {
    echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter.']);
    exit;
}

$idClient = $_SESSION['id_client'];
$idTshirt = $_POST['id_tshirt'] ?? null;
$taille = $_POST['taille'] ?? 1;
$quantite = $_POST['quantite'] ?? 1;

if (!$idTshirt || $quantite < 1) {
    echo json_encode(['success' => false, 'message' => 'Paramètres invalides.']);
    exit;
}

$commandeDAO = new CommandeDAO($pdo);
$detailDAO = new DetailCommandeDAO($pdo);
$tshirtDAO = new TshirtDAO($pdo);

$commande = $commandeDAO->getCommandeEnCours($idClient);
if (!$commande) {
    $commandeId = $commandeDAO->createCommande($idClient);
} else {
    $commandeId = $commande->__get('id_commande');
}

$tshirt = $tshirtDAO->findById((int)$idTshirt);
if (!$tshirt) {
    echo json_encode(['success' => false, 'message' => 'T-shirt introuvable.']);
    exit;
}

$prix = $tshirt->__get('prix');
$detailDAO->ajouterDetail($commandeId, $idTshirt, $taille, $quantite, $prix);

echo json_encode(['success' => true, 'message' => 'T-shirt ajouté au panier.']);
