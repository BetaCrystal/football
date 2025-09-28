<?php
class MatchFoot
{
    public int $id;
    public int $scoreEquipe;
    public int $scoreAdverse;
    public DateTime $dateMatch;
    public string $ville;
    public int $teamId;
    public int $opponentId; // ref appartenances, faire dossier par typologie, faire jeu d'essais

    public function __construct(
        int $id,
        int $scoreEquipe,
        int $scoreAdverse,
        string $dateMatch,
        string $ville,
        int $teamId,
        int $opponentId
    ) {
        $this->id = $id;
        $this->scoreEquipe = $scoreEquipe;
        $this->scoreAdverse = $scoreAdverse;
        $this->dateMatch = new DateTime($dateMatch);
        $this->ville = $ville;
        $this->teamId = $teamId;
        $this->opponentId = $opponentId;
    }

    // Instancie un MatchFoot depuis un tableau associatif + evite de répéter le code ex:t dans getById et getAll
    private static function fromArray(array $row): MatchFoot
    {
        return new MatchFoot(
            $row['id'],
            $row['team_score'],
            $row['opponent_score'],
            $row['date'],
            $row['city'],
            $row['team_id'],
            $row['opposing_club_id']
        );
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM matches ORDER BY date DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = self::fromArray($row);
        }
        return $result;
    }

    public static function create(PDO $pdo, int $scoreEquipe, int $scoreAdverse, string $dateMatch, string $ville, int $teamId, int $opponentId): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO matches (team_score, opponent_score, date, city, team_id, opposing_club_id) VALUES (:team_score, :opponent_score, :date, :city, :team_id, :opponent_id)");
            return $stmt->execute([
                ':team_score' => $scoreEquipe,
                ':opponent_score' => $scoreAdverse,
                ':date' => $dateMatch,
                ':city' => $ville,
                ':team_id' => $teamId,
                ':opponent_id' => $opponentId
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete(PDO $pdo, int $id): bool
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM matches WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getById(PDO $pdo, int $id): ?MatchFoot
    {
        $stmt = $pdo->prepare("SELECT * FROM matches WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromArray($row) : null;
    }

    public static function update(PDO $pdo, int $id, int $scoreEquipe, int $scoreAdverse, string $dateMatch, string $ville, int $teamId, int $opponentId): bool
    {
        try {
            $stmt = $pdo->prepare("UPDATE matches SET team_score = :team_score, opponent_score = :opponent_score, date = :date, city = :city, team_id = :team_id, opposing_club_id = :opponent_id WHERE id = :id");
            return $stmt->execute([
                ':team_score' => $scoreEquipe,
                ':opponent_score' => $scoreAdverse,
                ':date' => $dateMatch,
                ':city' => $ville,
                ':team_id' => $teamId,
                ':opponent_id' => $opponentId,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
}