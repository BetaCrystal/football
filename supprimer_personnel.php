<?php

include "includes/db.php";
require_once "classes/Personnel.php";
if ($_GET['id']){
        Personnel::delete($pdo, $_GET['id']);
}
header("Location: index.php");
exit;