<?php

namespace App\Classes;

include "../includes/header.php";

class Joueur extends Personne
{
    public DateTime $dateNaissance;

        public function __construct(int $id, string $nom, string $prenom, string $dateNaissance, string $photo)
        {
                parent::__construct($id, $nom, $prenom, $photo); // Appel du constructeur dans Personne
                $this->dateNaissance = new DateTime($dateNaissance);
        }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM player ORDER BY last_name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Joueur(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['birth_date'],
                $row['picture']
            );
        }
        return $result;
    }

    public static function getById(PDO $pdo, int $id): ?Joueur
    {
        $stmt = $pdo->prepare("SELECT * FROM player WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Joueur(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['birth_date'],
                $row['picture']
            );
        }
        return null;
    }

    public static function create(PDO $pdo, string $nom, string $prenom, string $dateNaissance, string $photo): void //Créer un joueur de type Joueur (enlever les parametres)
    { //faire une classe PDO à hériter
        $sql = "INSERT INTO player (last_name, first_name, birth_date, picture)
                VALUES (:nom, :prenom, :birth_date, :photo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':birth_date' => $dateNaissance,
            ':photo' => $photo
        ]);
    }

   public static function update(PDO $pdo, int $id, string $nom, string $prenom, string $dateNaissance, string $photo): bool
{
    $sql = "UPDATE player
            SET last_name = :nom, first_name = :prenom, birth_date = :birth_date, picture = :photo
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':birth_date' => $dateNaissance,
        ':photo' => $photo
    ]);
}

    public static function delete(PDO $pdo, int $id): void // supprimer un joueur de la base de données
    {
        $stmt = $pdo->prepare("DELETE FROM player WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
