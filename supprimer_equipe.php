<?php
include "includes/db.php";
require_once "classes/Equipe.php";
if ($_GET['id']){
        Equipe::delete($pdo, $_GET['id']);
}

header("Location: index.php");
exit;
?>