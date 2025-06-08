<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../../client/src/php/db/db.php';
require_once '../../client/src/php/classes/TshirtDAO.php';

$pdo = getPDO();
$dao = new TshirtDAO($pdo);

$id = $_GET['id'] ?? null;

if ($id) {
    $dao->delete((int)$id);
}

header('Location: ../index.php');
exit;
