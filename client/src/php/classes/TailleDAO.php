<?php
require_once 'Taille.php';

class TailleDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM tailles ORDER BY libelle");
        $tailles = [];
        while ($row = $stmt->fetch()) {
            $tailles[] = new Taille($row);
        }
        return $tailles;
    }
}
