<?php

namespace App\Classes;
use PDO;
use PDOException;

include "../includes/header.php";

class MatchFootPDO extends MatchFoot
{

    public function __construct(private PDO $pdo)
    {
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

    public static function create(PDO $pdo, MatchFoot $match): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO matches (team_score, opponent_score, date, city, team_id, opposing_club_id) VALUES (:team_score, :opponent_score, :date, :city, :team_id, :opponent_id)");
            return $stmt->execute([
                ':team_score' => $match->getScoreEquipe(),
                ':opponent_score' => $match->getScoreAdverse(),
                ':date' => $match->getDateMatch(),
                ':city' => $match->getVille(),
                ':team_id' => $match->getTeamId(),
                ':opponent_id' => $match->getOpponentId()
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete(PDO $pdo, MatchFoot $match): bool
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM matches WHERE id = :id");
            return $stmt->execute([':id' => $match->getId()]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getById(PDO $pdo, MatchFoot $match): ?MatchFoot
    {
        $stmt = $pdo->prepare("SELECT * FROM matches WHERE id = :id");
        $stmt->execute([':id' => $match->getId()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromArray($row) : null;
    }

    public static function update(PDO $pdo, MatchFoot $match): bool
    {
        try {
            $stmt = $pdo->prepare("UPDATE matches SET team_score = :team_score, opponent_score = :opponent_score, date = :date, city = :city, team_id = :team_id, opposing_club_id = :opponent_id WHERE id = :id");
            return $stmt->execute([
                ':team_score' => $match->getScoreEquipe(),
                ':opponent_score' => $match->getScoreAdverse(),
                ':date' => $match->getDateMatch(),
                ':city' => $match->getVille(),
                ':team_id' => $match->getTeamId(),
                ':opponent_id' => $match->getOpponentId(),
                ':id' => $match->getId()
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

}