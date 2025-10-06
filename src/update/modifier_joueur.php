<?php

include "../includes/header.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID manquant");
}

// Récupérer joueur
$player = Joueur::getById($pdo, $id);

if (!$player) {
    die("Joueur introuvable");
}



//VALIDATIION FORMULAIRE + MISE A JOUR DANS LA BASE DE DONNEES
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['prenom'] ?? '';
    $prenom = $_POST['nom'] ?? '';
    $dateNaissance = $_POST['birth_date'] ?? '';
    $photo = $_POST['photo'] ?? '';

    $d = DateTime::createFromFormat('Y-m-d', $dateNaissance);
    $isValidDate = $d && $d->format('Y-m-d') === $dateNaissance;

    if (!empty($nom) && !empty($prenom) && $isValidDate) {
        if (Joueur::update($pdo, $id, $nom, $prenom, $dateNaissance, $photo)) {
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red'>Erreur lors de la mise à jour.</p>";
        }
    } else {
        echo "<p style='color:red'>Données invalides. Veuillez vérifier les champs.</p>";
    }
}
?>
    <h1>Modifier joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($player->prenom) ?>" required><br>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($player->nom) ?>" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birth_date" value="<?= $player->dateNaissance->format('Y-m-d') ?>" required><br>

        <label>Photo (URL) :</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($player->photo) ?>"><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
