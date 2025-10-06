<?php

include "../includes/header.php";

if ($_GET['id']){
        Personnel::delete($pdo, $_GET['id']);
}
header("Location: index.php");
exit;