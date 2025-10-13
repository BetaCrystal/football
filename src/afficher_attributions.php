<?php

include "includes/header.php";

use App\PDO\AppartenancePDO;

$appartenances = AppartenancePDO::getByPlayerId($pdo, $_GET['id']);


?>

<h1>Equipes du joueur "<?php //echo  ?>"</h1>