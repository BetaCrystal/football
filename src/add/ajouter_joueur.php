<?php

include "../includes/header.php";

use App\PDO\JoueurPDO;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    JoueurPDO::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['birth_date'], $_POST['picture']);
    header("Location: index.php");
    exit;
}

?>
    <h1>Ajouter un joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label>Nom :</label>
        <input type="text" name="nom" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birth_date"><br>

        <label>Photo (URL) :</label>
        <input type="text" name="picture"><br><br>

        <button type="submit">Ajouter</button>
    </form>
<?php
include "includes/footer.php";
?>