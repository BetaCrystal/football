<?php

include "includes/header.php";

use App\PDO\JoueurPDO;
use App\PDO\EquipePDO;
use App\PDO\AppartenancePDO;

$joueur = JoueurPDO::getById($pdo, $_GET['id']);
$equipes = EquipePDO::getAll($pdo);

if (!$joueur) {
    echo "Joueur non trouvé.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    AppartenancePDO::create($pdo, $joueur->id, $_POST['equipe_id'], $_POST['role']);
    header("Location: afficher_attributions.php?joueur_id={$joueur->id}");
    exit;
}
?>

<h1>Associer <?php echo $joueur->nom; ?> à une équipe</h1>
<form method="post" action="">
    <input type="hidden" name="joueur_id" value="<?php echo $joueur->id; ?>">
    <label for="equipe">Choisir une équipe :</label>
    <select name="equipe_id" id="equipe">
        <?php foreach ($equipes as $equipe): ?>
            <option value="<?php echo $equipe->id; ?>"><?php echo htmlspecialchars($equipe->nom); ?></option>
        <?php endforeach; ?>
    </select>
    <label for="role">Rôle :</label>
        <select type="text" name="role" id="role" required>
        <option value="attaquant">Attaquant</option>
        <option value="milieu">Milieu</option>
        <option value="défenseur">Défenseur</option>
        <option value="gardien">Gardien</option>
        </select>
    <button type="submit">Attribuer</button>
</form>