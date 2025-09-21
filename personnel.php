<?php
class Personnel
{
    public int $id;
    public string $nom;
    public string $prenom;
    public string $role;
    public string $photo;

    public function __construct($id, $nom, $prenom, $role, $photo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role = $role;
        $this->photo = $photo;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM staff_member ORDER BY last_name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Personnel(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['role'],
                $row['picture']
            );
        }
        return $result;
    }

    public static function getById(PDO $pdo, int $id): ?Personnel
    {
        $stmt = $pdo->prepare("SELECT * FROM staff_member WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Personnel(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['picture'],
                $row['role']
            );
        }
        return null;
    }

    public static function create(PDO $pdo, string $nom, string $prenom, string $photo, string $role): void
    {
        $sql = "INSERT INTO staff_member (last_name, first_name, picture, role)
                VALUES (:nom, :prenom, :photo, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':photo' => $photo,
            ':role' => $role
        ]);
    }

    public static function update(PDO $pdo, int $id, string $nom, string $prenom, string $photo, string $role): bool
    {
        $sql = "UPDATE staff_member
                SET last_name = :nom, first_name = :prenom, picture = :photo, role = :role
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':photo' => $photo,
            ':role' => $role,
            ':id' => $id
        ]);
    }

    public static function delete(PDO $pdo, int $id): void
    {
        $stmt = $pdo->prepare("DELETE FROM staff_member WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
