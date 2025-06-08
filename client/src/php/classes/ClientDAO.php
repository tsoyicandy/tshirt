<?php
require_once 'Client.php';

class ClientDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?Client {
        $sql = "SELECT * FROM clients WHERE id_client = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new Client($row) : null;
    }

    public function findByEmail(string $email): ?Client {
        $sql = "SELECT * FROM clients WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ? new Client($row) : null;
    }
}

