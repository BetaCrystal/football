<?php

namespace App\PDO;

use PDO;
use App\Classes\Appartenance;
use App\Classes\Joueur;
use App\Classes\Equipe;

class AppartenancePDO
{
    public function __construct(private PDO $pdo)
    {

    }

    public static function getAll(PDO $pdo): array
    {
        $sql = "SELECT * FROM player_has_team";
        $stmt = $pdo->query($sql);
        $appartenances = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $joueur = JoueurPDO::getById($pdo, $row['player_id']);
            $equipe = EquipePDO::getById($pdo, $row['team_id']);
            if ($joueur && $equipe)
            {
                $appartenances[] = new Appartenance($row['role'], $joueur, $equipe);
            }
        }

        return $appartenances;
    }

    public static function getById(PDO $pdo, int $playerId, int $teamId): ?Appartenance
    {
        $sql = "SELECT * FROM player_has_team
        WHERE player_id = :player_id AND team_id = :team_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row)
        {
            $joueur = JoueurPDO::getById($pdo, $row['player_id']);
            $equipe = EquipePDO::getById($pdo, $row['team_id']);

            return new Appartenance($row['role'], $joueur, $equipe);
        }

        return null;
    }

    public static function getByPlayerId(PDO $pdo, int $playerId): array
    {
        $sql = "SELECT * FROM player_has_team WHERE player_id = :player_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':player_id' => $playerId]);
        $appartenances = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $joueur = JoueurPDO::getById($pdo, $row['player_id']);
            $equipe = EquipePDO::getById($pdo, $row['team_id']);
            if ($joueur && $equipe)
            {
                $appartenances[] = new Appartenance($row['role'], $joueur, $equipe);
            }
        }

        return $appartenances;
    }

    // Crée une appartenance par identifiants de joueur, d'équipe et rôle
    public static function create(PDO $pdo, int $playerId, int $teamId, string $role): void
    {
        $sql = "INSERT INTO player_has_team (player_id, team_id, role)
        VALUES (:player_id, :team_id, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId, ':role' => $role]);
    }

    // Supprime une appartenance par identifiants de joueur et d'équipe
   
    public static function delete(PDO $pdo, int $playerId, int $teamId): int
    {
        $sql = "DELETE FROM player_has_team
        WHERE player_id = :player_id AND team_id = :team_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId]);

        return $stmt->rowCount();
    }

    // Met à jour une appartenance par identifiants de joueur et d'équipe
    public static function update(PDO $pdo, int $playerId, int $oldTeamId, int $newTeamId, string $role): bool
    {
        $sql = "UPDATE player_has_team SET role = :role, team_id = :new_team_id WHERE player_id = :player_id AND team_id = :old_team_id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':player_id' => $playerId,
            ':old_team_id' => $oldTeamId,
            ':new_team_id' => $newTeamId,
            ':role' => $role
        ]);
    }

    // Vérification si un joueur a une équipe attribuée et retourne une chaîne descriptive
    public static function hasTeam(PDO $pdo, Joueur $joueur): string
    {
        $playerId = $joueur->getId();
        $appartenances = self::getByPlayerId($pdo, $playerId);

        if (count($appartenances) === 0)
        {
            return 'équipe non attribuée';
        }

        $parts = [];
        foreach ($appartenances as $appartenance)
        {
            $team = $appartenance->equipe;
            if ($team)
            {
                $teamName = $team->getNom();
                $role = $appartenance->getRole();
                $parts[] = sprintf('%s (%s)', $teamName, $role);
            }
        }

        return implode(', ', $parts);
    }
}
