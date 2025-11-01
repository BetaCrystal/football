<?php

require __DIR__ . "/../includes/header.php";

use App\PDO\JoueurPDO;
use App\PDO\EquipePDO;
use App\PDO\AppartenancePDO;

$joueur = JoueurPDO::getById($pdo, (int)($_GET['id'] ?? 0));
$equipes = EquipePDO::getAll($pdo);

if (!$joueur)
{
    echo "Joueur non trouvé.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $teamId = (int)($_POST['equipe_id'] ?? 0);
    $role = trim((string)($_POST['role'] ?? ''));
    AppartenancePDO::create($pdo, $joueur->getId(), $teamId, $role);
    header("Location: ../afficher_appartenances.php?id={$joueur->getId()}");
    exit;
}

?>

<h1>Associer <?php echo htmlspecialchars($joueur->getNom()); ?> à une équipe</h1>
<form method="post" action="">
    <input type="hidden" name="joueur_id" value="<?php echo $joueur->getId(); ?>">
    <label for="equipe">Choisir une équipe :</label>
    <select name="equipe_id" id="equipe">
        <?php foreach ($equipes as $equipe): ?>
            <option value="<?php echo $equipe->getId(); ?>"><?php echo htmlspecialchars($equipe->getNom()); ?></option>
        <?php endforeach; ?>
    </select>
    <label for="role">Rôle :</label>
        <select name="role" id="role" required>
        <option value="attaquant">Attaquant</option>
        <option value="milieu">Milieu</option>
        <option value="défenseur">Défenseur</option>
        <option value="gardien">Gardien</option>
        </select>
    <button type="submit">Attribuer</button>
</form>

<?php
// Afficher les appartenances existantes pour ce joueur et proposer modifier/supprimer
$appartenances = AppartenancePDO::getByPlayerId($pdo, $joueur->getId());
if (count($appartenances) > 0): ?>
    <h2>Appartenances existantes</h2>
    <table border="1" cellpadding="4">
        <tr>
            <th>ID équipe</th>
            <th>Nom équipe</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($appartenances as $app): ?>
        <tr>
            <td><?= htmlspecialchars($app->equipe->getId()) ?></td>
            <td><?= htmlspecialchars($app->equipe->getNom()) ?></td>
            <td><?= htmlspecialchars($app->getRole()) ?></td>
            <td>
                <a href="../modifier/modifier_appartenance.php?player_id=<?= $app->joueur->getId() ?>&team_id=<?= $app->equipe->getId() ?>">Modifier</a> |
                <a href="../supprimer/supprimer_appartenance.php?player_id=<?= $app->joueur->getId() ?>&team_id=<?= $app->equipe->getId() ?>" onclick="return confirm('Supprimer cette appartenance ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucune appartenance trouvée pour ce joueur.</p>
<?php endif; ?>