<?php

namespace App\Classes;
use PDO;

include "../includes/header.php";

class AdversairePDO extends Adversaire
{
    public function __construct(private PDO $pdo)
    {
    }


        public function getAll(): array
        {
                $stmt = $this->pdo->query("SELECT * FROM opposing_club; ");
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $result = [];
                foreach ($rows as $row) {
                        $result[] = new Adversaire(
                        $row['id'],
                        $row['address'],
                        $row['city']
                        );
                }
                return $result;
        }

        public static function getById(PDO $pdo, int $id): ?Adversaire
        {
                $stmt = $pdo->prepare("SELECT * FROM opposing_club WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                        return new Adversaire(
                        $row['id'],
                        $row['address'],
                        $row['city']
                        );
                }
                return null;
        }

        public function create(Adversaire $adversaire): void
    {
        $sql = "INSERT INTO opposing_club (address, city)
                VALUES (:adresse, :ville)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':adresse' => $adversaire->getAdresse(),
            ':prenom' => $adversaire->getVille()
        ]);
    }

    public static function update(PDO $pdo, Adversaire $adversaire): bool
    {
        $sql = "UPDATE opposing_club
                SET address = :adresse, city = :ville
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $adversaire->getId(),
            ':adresse' => $adversaire->getAdresse(),
            ':ville' => $adversaire->getVille()
        ]);
    }


    public static function delete(PDO $pdo, Adversaire $adversaire): void
    {
        $stmt = $pdo->prepare("DELETE FROM opposing_club WHERE id = :id");
        $stmt->execute([':id' => $adversaire->getId()]);
    }
}