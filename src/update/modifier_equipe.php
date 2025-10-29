<?php

require __DIR__."/../includes/header.php";

use App\PDO\EquipePDO;

$id = $_GET['id'];
if (!isset($id))
{
    die("ID manquant");
}

$team = EquipePDO::getById($pdo, $_GET['id']);
if (!$team)
{
    die("Équipe introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']))
{
    $nom = $_POST['nom'];
    $nouvEquipe = new App\Classes\Equipe($id, $nom);
    EquipePDO::update($pdo, $nouvEquipe);
    header("Location: ../../public/index.php");
    exit;
}
