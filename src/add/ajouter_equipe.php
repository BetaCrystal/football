<?php

require __DIR__."/../includes/header.php";

use App\PDO\EquipePDO;

$id = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']))
{
    $nouvEquipe = new App\Classes\Equipe($id, $_POST['nom']);
    EquipePDO::create($pdo, $nouvEquipe);
    header("Location: ../../public/index.php");
    exit;
}
