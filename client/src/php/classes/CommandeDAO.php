<?php
require_once  'Commande.php';

class CommandeDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getCommandeEnCours(int $idClient): ?Commande {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes WHERE id_client = :id AND statut = 'en attente' LIMIT 1");
        $stmt->execute(['id' => $idClient]);
        $row = $stmt->fetch();
        return $row ? new Commande($row) : null;
    }

    public function createCommande(int $idClient): int {
        $stmt = $this->pdo->prepare("INSERT INTO commandes (id_client) VALUES (:id) RETURNING id_commande");
        $stmt->execute(['id' => $idClient]);
        return $stmt->fetchColumn();
    }

    public function update(Commande $commande): void {
        $sql = "UPDATE commandes 
            SET statut = :statut, date_commande = :date_commande 
            WHERE id_commande = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'statut' => $commande->__get('statut'),
            'date_commande' => $commande->__get('date_commande'),
            'id' => $commande->__get('id_commande')
        ]);
    }
    public function getAllByClient(int $idClient): array {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes WHERE id_client = :id ORDER BY date_commande DESC");
        $stmt->execute(['id' => $idClient]);

        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new Commande($row);
        }
        return $result;
    }


}
