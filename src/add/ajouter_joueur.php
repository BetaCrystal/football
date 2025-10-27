<?php

require __DIR__."/../includes/header.php";

use App\PDO\JoueurPDO;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    JoueurPDO::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['birth_date'], $_POST['picture']);
    header("Location: index.php");
    exit;
}
