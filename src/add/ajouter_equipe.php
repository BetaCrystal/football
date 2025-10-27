<?php

require __DIR__."/../includes/header.php";

use App\PDO\EquipePDO;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']))
{
    EquipePDO::create($pdo, $_POST['nom']);
    header("Location: index.php");
    exit;
}
