<?php
require_once 'Categorie.php';

class CategorieDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM categories ORDER BY nom");
        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = new Categorie($row);
        }
        return $categories;
    }
}
