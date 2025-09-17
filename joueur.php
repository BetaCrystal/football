<?php
class Joueur
{
    public int $id;
    public string $nom;
    public string $prenom;
    public DateTime $dateNaissance;
    public string $photo;

    public function __construct($id, $nom, $prenom, $dateNaissance, $photo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = new DateTime($dateNaissance);
        $this->photo = $photo;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM player ORDER BY lastname");
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
                $row['lastname'],
                $row['firstname'],
                $row['birthdate'],
                $row['picture']
            );
        }
        return null;
    }

    public static function create(PDO $pdo, string $nom, string $prenom, string $dateNaissance, string $photo): void //Créer un joueur
    {
        $sql = "INSERT INTO player (lastname, firstname, birthdate, picture) 
                VALUES (:nom, :prenom, :birthdate, :photo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':birthdate' => $dateNaissance,
            ':photo' => $photo
        ]);
    }

    public static function update(PDO $pdo, int $id, string $nom, string $prenom, string $dateNaissance, string $photo): void //mettre à jour les infos d'un joueur
    {
        $sql = "UPDATE player 
                SET lastname = :nom, firstname = :prenom, birthdate = :birthdate, picture = :photo
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':birthdate' => $dateNaissance,
            ':photo' => $photo
        ]);
    }

    public static function delete(PDO $pdo, int $id): void // supprimer un joueur de la base de données
    {
        $stmt = $pdo->prepare("DELETE FROM player WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
