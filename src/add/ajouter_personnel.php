<?php

require __DIR__."/../includes/header.php";

use App\PDO\PersonnelPDO;

$id = null;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nouvPersonnel = new App\Classes\Personnel($id, $_POST['nom'], $_POST['prenom'], $_POST['role'], $_POST['photo']);
    PersonnelPDO::create($pdo, $nouvPersonnel);
    header("Location: ../../public/index.php");
    exit;
}
