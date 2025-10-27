<?php

require __DIR__."/../includes/header.php";

use App\PDO\PersonnelPDO;

//On récupère le personnel par son ID
$staff = PersonnelPDO::getById($pdo, $_GET['id']);

if (!$staff)
{
    die("Personnel introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["role"]))
    {
        $sql = "UPDATE staff_member
        SET last_name = :nom, first_name = :prenom, role = :role, picture = :photo
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':role' => $_POST['role'],
            ':photo' => $photo,
            ':id' => $staff->getId()
        ]);
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red'>Données invalides. Veuillez vérifier les champs.</p>";
    }
}
