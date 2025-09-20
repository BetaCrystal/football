<?php
require_once "includes/db.php";
require_once "joueur.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Joueur::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['birth_date'], $_POST['picture']);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un joueur</title>
</head>
<body>
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
</body>
</html>
