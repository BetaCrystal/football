
<?php
class Equipe
{
    public int $id;
    public string $nom;

    public function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM team ORDER BY name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Equipe($row['id'], $row['name']);
        }
        return $result;
    }

    public static function create(PDO $pdo, string $nom): void
    {
        $stmt = $pdo->prepare("INSERT INTO team (name) VALUES (:nom)");
        $stmt->execute([':nom' => $nom]);
    }
}
