<?php
require_once "joueur.php";
require_once "equipe.php";

class Appartenance{
        public string $role;
        public Joueur $joueur;
        public Equipe $equipe;

        public function __construct(string $role, Joueur $joueur, Equipe $equipe)
        {
                $this->role = $role;
                $this->joueur = $joueur;
                $this->equipe = $equipe;
        }

        public static function getAll(PDO $pdo): array
        {
                $sql = "SELECT * FROM player_has_team";
                $stmt = $pdo->query($sql);
                $appartenances = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $joueur = Joueur::getById($pdo, $row['player_id']);
                        $equipe = Equipe::getById($pdo, $row['team_id']);
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
                        $joueur = Joueur::getById($pdo, $row['player_id']);
                        $equipe = Equipe::getById($pdo, $row['team_id']);
                        return new Appartenance($row['role'], $joueur, $equipe);
                }
                return null;
        }

        public static function create(PDO $pdo, int $playerId, int $teamId, string $role): void
        {
                $sql = "INSERT INTO player_has_team (player_id, team_id, role) VALUES (:player_id, :team_id, :role)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId, ':role' => $role]);
        }

        public static function delete(PDO $pdo, int $playerId, int $teamId): void
        {
                $sql = "DELETE FROM player_has_team WHERE player_id = :player_id AND team_id = :team_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':player_id' => $playerId, ':team_id' => $teamId]);
        }

        public static function update(PDO $pdo, int $playerId, int $teamId, string $role): bool
        {
                $sql = "UPDATE player_has_team SET role = :role, team_id = :team_id WHERE player_id = :player_id AND team_id = :team_id";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([':role' => $role, ':player_id' => $playerId, ':team_id' => $teamId]);
        }

        public static function hasTeam(PDO $pdo, int $playerId): string{
                $all_appartenances = self::getAll($pdo);
                foreach($all_appartenances as $appartenance){
                        if($appartenance->joueur->id === $playerId){
                                return "<a href='voir_appartenance.php?id=$playerId'>Oui</a>";
                        }
                }
                return "<a href='attribuer_equipe.php?id=$playerId'>Non</a>";
        }
}
?>