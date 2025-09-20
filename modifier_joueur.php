<?php
require_once "includes/db.php";
include "includes/header.php";
require_once "joueur.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID manquant");
}

// Récupérer joueur
$player = Joueur::getById($pdo, $id);

if (!$player) {
    die("Joueur introuvable");
}

// Mise à jour dans la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        Joueur::update($pdo, $id, $_POST['nom'], $_POST['prenom'], $_POST['birthdate'], $_POST['photo']);

    header("Location: index.php");
    exit;
}
?>
    <h1>Modifier joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($player->prenom) ?>" required><br>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($player->nom) ?>" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birthdate" value="<?= $player->dateNaissance->format('d/m/Y') ?>"><br>

        <label>Photo (URL) :</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($player->photo) ?>"><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
