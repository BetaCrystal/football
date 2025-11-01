<?php

include "includes/header.php";

use App\PDO\AppartenancePDO;

$appartenances = AppartenancePDO::getByPlayerId($pdo, $_GET['id']);