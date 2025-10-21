<?php

include "../includes/header.php";

use App\PDO\EquipePDO;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']))
{
    EquipePDO::create($pdo, $_POST['nom']);
    header("Location: index.php");
    exit;
}

?>

<form method="post" action="">
    <label>Nom de l'équipe :</label>
    <input type="text" name="nom"><br><br>
    <button type="submit">Ajouter</button>



<?php include "includes/footer.php"; ?>