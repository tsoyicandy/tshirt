<?php
require_once  'DetailCommande.php';

class DetailCommandeDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterDetail($commandeId, $tshirtId, $tailleId, $quantite, $prixUnitaire): void {
        $sql = "INSERT INTO details_commande (id_commande, id_tshirt, id_taille, quantite, prix_unitaire)
                VALUES (:commande, :tshirt, :taille, :quantite, :prix)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'commande' => $commandeId,
            'tshirt' => $tshirtId,
            'taille' => $tailleId,
            'quantite' => $quantite,
            'prix' => $prixUnitaire
        ]);
    }

    public function getDetailsByCommande(int $commandeId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM details_commande WHERE id_commande = :id");
        $stmt->execute(['id' => $commandeId]);
        $details = [];
        while ($row = $stmt->fetch()) {
            $details[] = new DetailCommande($row);
        }
        return $details;
    }

    public function delete(int $id_detail): void {
        $stmt = $this->pdo->prepare("DELETE FROM details_commande WHERE id_detail = :id");
        $stmt->execute(['id' => $id_detail]);
    }

}
