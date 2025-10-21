<?php

include "../includes/header.php";

use App\PDO\EquipePDO;

if (!isset($_GET['id']))
{
    die("ID manquant");
}

$team = EquipePDO::getById($pdo, $_GET['id']);
if (!$team)
{
    die("Équipe introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']))
{
    EquipePDO::update($pdo, $team, $_POST['nom']);
    header("Location: index.php");
    exit;
}

?>

<h1>Modifier une équipe</h1>
<form method="post" action="">
        <label>Nom de l'équipe :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($team->getNom()) ?>"><br><br>
        <button type="submit">Enregistrer</button>
</form>
<?php include "includes/footer.php"; ?>