<?php
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    $birthdate = $_POST["birth_date"];
    $picture = $_POST["picture"]; // URL de l’image carte fifa

    $sql = "INSERT INTO player (first_name, last_name, birth_date, picture) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstname, $lastname, $birthdate, $picture]);

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
        <input type="text" name="first_name" required><br>
        
        <label>Nom :</label>
        <input type="text" name="last_name" required><br>
        
        <label>Date de naissance :</label>
        <input type="date" name="birth_date"><br>
        
        <label>Photo (URL) :</label>
        <input type="text" name="picture"><br><br>
        
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

