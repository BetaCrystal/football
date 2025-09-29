<?php

namespace App\Classes;

class Equipe
{
    public int $id;
    public string $nom;

    public function __construct(int $id, string $nom)
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

        public static function delete(PDO $pdo, int $id): void
        {
                $stmt = $pdo->prepare("DELETE FROM team WHERE id = :id");
                $stmt->execute([':id' => $id]);
        }

        public static function getById(PDO $pdo, int $id): ?Equipe
        {
                $stmt = $pdo->prepare("SELECT * FROM team WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                        return new Equipe($row['id'], $row['name']);
                }
                return null;
        }

        public static function update(PDO $pdo, int $id, string $nom): void
        {
                $stmt = $pdo->prepare("UPDATE team SET name = :nom WHERE id = :id");
                $stmt->execute([':nom' => $nom, ':id' => $id]);
        }
}
