<?php

require __DIR__."/../includes/header.php";

use App\PDO\EquipePDO;

if ($_GET['id'])
{
    EquipePDO::delete($pdo, $_GET['id']);
}

header("Location: ../../public/index.php");
exit;
