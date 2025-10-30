<?php

namespace App\PDO;

use PDO;
use App\Classes\Equipe;

class EquipePDO
{
    public function __construct(private PDO $pdo)
    {

    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM team ORDER BY name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row)
        {
            $result[] = new Equipe($row['id'], $row['name']);
        }

        return $result;
    }

    public static function create(PDO $pdo, Equipe $equipe): void
    {
        $stmt = $pdo->prepare("INSERT INTO team (name)
        VALUES (:nom);");
        $stmt->execute([':nom' => $equipe->getNom()]);
    }

    public static function delete(PDO $pdo, Equipe $equipe): void
    {
        $stmt = $pdo->prepare("DELETE FROM team WHERE id = :id");
        $stmt->execute([':id' => $equipe->getId()]);
    }

    public static function getById(PDO $pdo, int $id): ?Equipe
    {
        $stmt = $pdo->prepare("SELECT * FROM team WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row)
        {
            return new Equipe($row['id'], $row['name']);
        }

        return null;
    }

    public static function update(PDO $pdo, Equipe $equipe): void
    {
        $stmt = $pdo->prepare("UPDATE team SET name = :nom WHERE id = :id");
        $stmt->execute([':nom' => $equipe->getNom(), ':id' => $equipe->getId()]);
    }
}
