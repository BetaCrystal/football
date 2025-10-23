<?php

use App\PDO\PersonnelPDO;

if ($_GET['id'])
{
    PersonnelPDO::delete($pdo, $_GET['id']);
}

header("Location: index.php");
exit;
