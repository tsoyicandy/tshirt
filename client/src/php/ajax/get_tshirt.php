<?php
require_once '../db/db.php';
require_once '../classes/TshirtDAO.php';
require_once '../classes/Tshirt.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$dao = new TshirtDAO(getPDO());
$tshirt = $dao->findById((int)$id);

if ($tshirt) {
    echo json_encode($tshirt->toArray());
} else {
    echo json_encode(['error' => 'T-shirt introuvable']);
}
