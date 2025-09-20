<?php
require_once "includes/db.php";
require_once "joueur.php";

if ($_GET['id']){
    Joueur::delete($pdo, $_GET['id']);
}

header("Location: index.php");
exit;
?>
