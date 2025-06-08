<?php
require_once 'Admin.php';

class AdminDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer un admin par email et mot de passe (non hashé)
    public function findByCredentials(string $email, string $motDePasse): ?Admin {
        $sql = "SELECT * FROM admin WHERE email = :email AND mot_de_passe = :mdp";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'mdp' => $motDePasse
        ]);
        $row = $stmt->fetch();
        return $row ? new Admin($row) : null;
    }

    // Insérer un nouvel admin (non hashé)
    public function insert(Admin $admin): void {
        $sql = "INSERT INTO admin (email, mot_de_passe) VALUES (:email, :mdp)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $admin->__get('email'),
            'mdp' => $admin->__get('mot_de_passe')
        ]);
    }

    // Supprimer un admin
    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM admin WHERE id_admin = :id");
        $stmt->execute(['id' => $id]);
    }

    // Obtenir tous les admins (utile pour lister si besoin)
    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM admin");
        $admins = [];
        while ($row = $stmt->fetch()) {
            $admins[] = new Admin($row);
        }
        return $admins;
    }
}
