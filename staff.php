<?php
class Staff
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
        $stmt = $pdo->query("SELECT * FROM staff_member ORDER BY lastname");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Staff(
                $row['id'],
                $row['lastname'],
                $row['firstname'],
                $row['role'],
                $row['picture']
            );
        }
        return $result;
    }
}
