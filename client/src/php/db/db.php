<?php
function getPDO(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $host = 'localhost';
        $port = '5432';
        $dbname = 'commerce_tshirts';
        $user = 'anonyme';
        $password = 'anonyme';
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    return $pdo;
}
