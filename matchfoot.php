<?php
class MatchFoot
{
    public int $id;
    public int $scoreEquipe;
    public int $scoreAdverse;
    public DateTime $dateMatch;
    public string $ville;
    public int $teamId;
    public int $opponentId;

    public function __construct($id, $scoreEquipe, $scoreAdverse, $dateMatch, $ville, $teamId, $opponentId)
    {
        $this->id = $id;
        $this->scoreEquipe = $scoreEquipe;
        $this->scoreAdverse = $scoreAdverse;
        $this->dateMatch = new DateTime($dateMatch);
        $this->ville = $ville;
        $this->teamId = $teamId;
        $this->opponentId = $opponentId;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM match ORDER BY date DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new MatchFoot(
                $row['id'],
                $row['team_score'],
                $row['opponent_score'],
                $row['date'],
                $row['city'],
                $row['team_id'],
                $row['opposing_club_id']
            );
        }
        return $result;
    }
}
