<?php

require_once 'classes/Appartenance.php';
include "includes/header.php";

$appartenances = Appartenance::getByPlayerId($pdo, $_GET['id']);


?>

<h1>Equipes du joueur "<?php //echo  ?>"</h1>