<?php
require_once 'Tshirt.php';

class TshirtDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $sql = "SELECT t.*, c.nom AS categorie 
        FROM tshirts t 
        LEFT JOIN categories c ON t.id_categorie = c.id_categorie 
        ORDER BY t.nom";
        $stmt = $this->pdo->query($sql);
        $_tshirts = [];
        while ($row = $stmt->fetch()) {
            $_tshirts[] = new Tshirt($row);
        }
        return $_tshirts;
    }

    public function findById(int $id): ?Tshirt {
        $sql = "SELECT * FROM tshirts WHERE id_tshirt = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new Tshirt($row) : null;
    }
}

