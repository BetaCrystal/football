<?php

namespace App\PDO;

use PDO;
use App\Classes\Joueur;
use DateTime;
class JoueurPDO
{
    public function __construct(private PDO $pdo)
    {

    }

    public static function getAll(PDO $pdo): array // récupérer tous les joueurs
    {
        $stmt = $pdo->query("SELECT * FROM player ORDER BY last_name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row)
        {
            $result[] = new Joueur(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                new DateTime ($row['birth_date']),
                $row['picture']
            );
        }

        return $result;
    }

    public static function getById(PDO $pdo, int $id): ?Joueur // récupérer un joueur par son ID
    {
        $stmt = $pdo->prepare("SELECT * FROM player WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row)
        {

            return new Joueur(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                new DateTime ($row['birth_date']),
                $row['picture']
            );
        }

        return null;
    }

    public static function create(PDO $pdo, Joueur $joueur): void // ajouter un nouveau joueur dans la base de données
    {
        $sql = "INSERT INTO player (last_name, first_name, birth_date, picture)
        VALUES (:nom, :prenom, :birth_date, :photo)";
        $stmt = $joueur->$pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $joueur->getNom(),
            ':prenom' => $joueur->getPrenom(),
            ':birth_date' => $joueur->getDateNaissance()->format('Y-m-d'),
            ':photo' => $joueur->getPhoto()
        ]);
    }

    public static function update(PDO $pdo, Joueur $joueur): bool // mettre à jour un joueur dans la base de données
    {
        $sql = "UPDATE player
        SET last_name = :nom, first_name = :prenom, birth_date = :birth_date, picture = :photo
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $joueur->getId(),
            ':nom' => $joueur->getNom(),
            ':prenom' => $joueur->getPrenom(),
            ':birth_date' => $joueur->getDateNaissance()->format('Y-m-d'),
            ':photo' => $joueur->getPhoto()
        ]);
    }

    public static function delete(PDO $pdo, int $id): void // supprimer un joueur dans la base de données
    {
        $stmt = $pdo->prepare("DELETE FROM player WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}