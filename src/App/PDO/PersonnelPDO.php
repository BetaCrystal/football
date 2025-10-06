<?php

namespace App\Classes;
use PDO;

include "../includes/header.php";

class PersonnelPDO extends Personnel
{

    public function __construct(private PDO $pdo)
    {
    }


        public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM staff_member ORDER BY last_name");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Personnel(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['role'],
                $row['picture']
            );
        }
        return $result;
    }

    public static function getById(PDO $pdo, Personnel $personnel): ?Personnel
    {
        $stmt = $pdo->prepare("SELECT * FROM staff_member WHERE id = :id");
        $stmt->execute([':id' => $personnel->getId()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Personnel(
                $row['id'],
                $row['last_name'],
                $row['first_name'],
                $row['picture'],
                $row['role']
            );
        }
        return null;
    }

    public static function create(PDO $pdo, Personnel $personnel): void
    {
        $sql = "INSERT INTO staff_member (last_name, first_name, picture, role)
                VALUES (:nom, :prenom, :photo, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $personnel->getNom(),
            ':prenom' => $personnel->getPrenom(),
            ':photo' => $personnel->getPhoto(),
            ':role' => $personnel->getRole()
        ]);
    }

    public static function update(PDO $pdo, Personnel $personnel): bool
    {
        $sql = "UPDATE staff_member
                SET last_name = :nom, first_name = :prenom, picture = :photo, role = :role
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $personnel->getNom(),
            ':prenom' => $personnel->getPrenom(),
            ':photo' => $personnel->getPhoto(),
            ':role' => $personnel->getRole(),
            ':id' => $personnel->getId()
        ]);
    }

    public static function delete(PDO $pdo, Personnel $personnel): void
    {
        $stmt = $pdo->prepare("DELETE FROM staff_member WHERE id = :id");
        $stmt->execute([':id' => $personnel->getId()]);
    }
}