<?php

use App\PDO\EquipePDO;

if ($_GET['id'])
{
    EquipePDO::delete($pdo, $_GET['id']);
}

header("Location: index.php");
exit;
