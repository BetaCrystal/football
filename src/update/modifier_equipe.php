<?php

include "../includes/header.php";

use App\PDO\EquipePDO;

if (!isset($_GET['id']))
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
    EquipePDO::update($pdo, $team, $_POST['nom']);
    header("Location: index.php");
    exit;
}
