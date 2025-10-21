<?php

include "../includes/header.php";

use App\PDO\PersonnelPDO;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    PersonnelPDO::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['photo'], $_POST['role']);
    header("Location: index.php");
    exit;
}

?>

        <h1>Ajouter un personnel</h1>
        <form method="post">
                <label>Prénom :</label>
                <input type="text" name="prenom" required><br>

                <label>Nom :</label>
                <input type="text" name="nom" required><br>

                <label>Photo (URL) :</label>
                <input type="text" name="photo"><br>

                <label>Rôle :</label>
                <select name="role">
                        <option value="Entraîneur">Entraîneur</option>
                        <option value="Préparateur">Préparateur</option>
                        <option value="Analyste">Analyste</option>
                </select>

                        <br><br>

                <button type="submit">Ajouter</button>
        </form>
<?php
include "includes/footer.php";?>