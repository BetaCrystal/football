<?php

namespace App\Classes;
use PDO;

include "../includes/header.php";

class AppartenancePDO extends Appartenance
{

            public function __construct(private PDO $pdo)
    {
    }


        public static function getAll(PDO $pdo): array
        {
                $sql = "SELECT * FROM player_has_team";
                $stmt = $pdo->query($sql);
                $appartenances = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $joueur = JoueurPDO::getById($pdo, $row['player_id']);
                        $equipe = EquipePDO::getById($pdo, $row['team_id']);
                        if ($joueur && $equipe) {
                                $appartenances[] = new Appartenance($row['role'], $joueur, $equipe);
                        }
                }
                return $appartenances;
        }

        public static function getById(PDO $pdo, int $playerId, int $teamId): ?Appartenance
        {
                $sql = "SELECT * FROM player_has_team WHERE player_id = :player_id AND team_id = :team_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
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
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $joueur = JoueurPDO::getById($pdo, $row['player_id']);
                        $equipe = EquipePDO::getById($pdo, $row['team_id']);
                        if ($joueur && $equipe) {
                                $appartenances[] = new Appartenance($row['role'], $joueur, $equipe);
                        }
                }
                return $appartenances;
        }

        public static function create(PDO $pdo, Joueur $joueur, Equipe $equipe, Appartenance $appartenance): void
        {
                $sql = "INSERT INTO player_has_team (player_id, team_id, role) VALUES (:player_id, :team_id, :role)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':player_id' => $joueur->getId(), ':team_id' => $equipe->getId(), ':role' => $appartenance->getRole()]);
        }

        public static function delete(PDO $pdo, Joueur $joueur, Equipe $equipe): void
        {
                $sql = "DELETE FROM player_has_team WHERE player_id = :player_id AND team_id = :team_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':player_id' => $joueur->getId(), ':team_id' => $equipe->getID()]);
        }

        public static function update(PDO $pdo, Joueur $joueur, Equipe $equipe, Appartenance $appartenance): bool
        {
                $sql = "UPDATE player_has_team SET role = :role, team_id = :team_id WHERE player_id = :player_id AND team_id = :team_id";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([':player_id' => $joueur->getId(), ':team_id' => $equipe->getId(), ':role' => $appartenance->getRole()]);
        }

        public static function hasTeam(PDO $pdo, Joueur $joueur): string{
                $all_appartenances = self::getAll($pdo);
                foreach($all_appartenances as $appartenance){
                        $joueurId = $joueur->getId();
                        if($appartenance->joueur->id === $joueurId){
                                return "<a href='voir_appartenance.php?id=$joueurId'>Oui</a>";
                        }
                }
                return "<a href='attribuer_equipe.php?id=$joueurId'>Non</a>";
        }

}