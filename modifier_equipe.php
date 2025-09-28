<?php
include "includes/db.php";
include "includes/header.php";
require_once "classes/Equipe.php";
if (!isset($_GET['id'])) {
    die("ID manquant");
}

$team = Equipe::getById($pdo, $_GET['id']);
if (!$team) {
    die("Équipe introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom'])) {
    Equipe::update($pdo, $team->id, $_POST['nom']);
    header("Location: index.php");
    exit;
}

?>

<h1>Modifier une équipe</h1>
<form method="post" action="">
        <label>Nom de l'équipe :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($team->nom) ?>"><br><br>
        <button type="submit">Enregistrer</button>
</form>
<?php include "includes/footer.php"; ?>