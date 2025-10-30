<?php

require __DIR__."/../includes/header.php";

use App\PDO\PersonnelPDO;

$id = $_GET['id'] ?? null;
if (!$id)
{
    die("ID manquant");
}

//On récupère le personnel par son ID
$staff = PersonnelPDO::getById($pdo, $id);

if (!$staff)
{
    die("Personnel introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["role"]))
    {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $role = $_POST['role'] ?? '';
        $photo = $_POST['photo'] ?? '';
        $nouvPersonnel = new App\Classes\Personnel($id, $nom, $prenom, $role, $photo);
        if (PersonnelPDO::update($pdo, $nouvPersonnel))
        {
            header("Location: ../../public/index.php");
            exit;
        } else {
            echo "<p style='color:red'>Erreur lors de la mise à jour.</p>";
        }
    } else {
        echo "<p style='color:red'>Données invalides. Veuillez vérifier les champs.</p>";
    }
}
