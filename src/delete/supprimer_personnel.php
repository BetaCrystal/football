<?php

require __DIR__."/../includes/header.php";

use App\PDO\PersonnelPDO;

if ($_GET['id'])
{
    PersonnelPDO::delete($pdo, $_GET['id']);
}

header("Location: ../../public/index.php");
exit;
