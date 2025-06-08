<?php
require_once '../db/db.php';
require_once '../classes/TshirtDAO.php';

header('Content-Type: application/json');

$pdo = getPDO();

$tshirtDAO = new TshirtDAO($pdo);
$tshirts = $tshirtDAO->findAll();

$data = [];
foreach ($tshirts as $tshirt) {
    $data[] = $tshirt->toArray();
}

echo json_encode($data);
