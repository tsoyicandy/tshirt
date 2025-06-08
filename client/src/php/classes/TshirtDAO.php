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

    public function insert(Tshirt $t): void {
        $sql = "INSERT INTO tshirts (nom, description, prix, image, id_categorie)
            VALUES (:nom, :description, :prix, :image, :id_categorie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'nom' => $t->__get('nom'),
            'description' => $t->__get('description'),
            'prix' => $t->__get('prix'),
            'image' => $t->__get('image'),
            'id_categorie' => $t->__get('id_categorie')
        ]);
    }
    public function update(Tshirt $t): void {
        $sql = "UPDATE tshirts SET nom = :nom, description = :description, prix = :prix,
            image = :image, id_categorie = :id_categorie WHERE id_tshirt = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'nom' => $t->__get('nom'),
            'description' => $t->__get('description'),
            'prix' => $t->__get('prix'),
            'image' => $t->__get('image'),
            'id_categorie' => $t->__get('id_categorie'),
            'id' => $t->__get('id_tshirt')
        ]);
    }
    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM tshirts WHERE id_tshirt = :id");
        $stmt->execute(['id' => $id]);
    }


}

