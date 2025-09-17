<?php
require_once "includes/db.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID manquant");
}

// Récupérer joueur
$stmt = $pdo->prepare("SELECT * FROM player WHERE id = ?");
$stmt->execute([$id]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$player) {
    die("Joueur introuvable");
}

// Mise à jour dans la base de données 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    $birthdate = $_POST["birth_date"];
    $picture = $_POST["picture"];

    $sql = "UPDATE player SET first_name=?, last_name=?, birth_date=?, picture=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstname, $lastname, $birthdate, $picture, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier joueur</title>
</head>
<body>
    <h1>Modifier joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="firstname" value="<?= htmlspecialchars($player['first_name']) ?>" required><br>
        
        <label>Nom :</label>
        <input type="text" name="lastname" value="<?= htmlspecialchars($player['last_name']) ?>" required><br>
        
        <label>Date de naissance :</label>
        <input type="date" name="birthdate" value="<?= $player['birth_date'] ?>"><br>
        
        <label>Photo (URL) :</label>
        <input type="text" name="picture" value="<?= htmlspecialchars($player['picture']) ?>"><br><br>
        
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
