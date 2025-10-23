<?php

use App\PDO\PersonnelPDO;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    PersonnelPDO::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['photo'], $_POST['role']);
    header("Location: index.php");
    exit;
}
