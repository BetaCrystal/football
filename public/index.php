<?php

require __DIR__."/../src/includes/header.php";

// Récupérer les joueurs
$players = App\PDO\JoueurPDO::getAll($pdo);


// Récupérer les équipes
$teams = App\PDO\EquipePDO::getAll($pdo);

// Récupérer le personnel
$staff = App\PDO\PersonnelPDO::getAll($pdo);


// Récupérer les appartenances
$appartenances = App\PDO\AppartenancePDO::getAll($pdo);
?>
    <h1>Liste des joueurs</h1>
    <a href="ajouter/ajouter_joueur.php"> Ajouter un joueur</a>
    <table border="1" cellpadding="8"> <?php // tableau css pour la présentation/c'est les catégories?>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Photo</th>
            <th>Equipe(s)</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($players as $player): ?>
        <tr>
            <td><?= $player->getId() ?></td>
            <td><?= htmlspecialchars($player->getNom()) ?></td>
            <td><?= htmlspecialchars($player->getPrenom()) ?></td>
            <td><?= $player->getDateNaissance()->format('d/m/Y') ?></td>
            <td>
                <?php if (!empty($player->getPhoto())): ?>
                    <img src="<?= $player->getPhoto() ?>" width="50">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td><?= App\PDO\AppartenancePDO::hasTeam($pdo, $player) ?></td>
            <td>
                <a href="modifier/modifier_joueur.php?id=<?= $player->getId() ?>"> Modifier</a> |
                <a href="supprimer/supprimer_joueur.php?id=<?= $player->getId() ?>" onclick="return confirm('Supprimer ce joueur ?');"> Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Liste des équipes</h1>
    <a href="ajouter/ajouter_equipe.php"> Ajouter une équipe</a>
    <table border="1" cellpadding="2">
        <tr>
                <th>ID</th>
                <th>Nom</th>
        </tr>
        <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= $team->getId() ?></td>
            <td><?= htmlspecialchars($team->getNom()) ?></td>
            <td>
                <a href="modifier/modifier_equipe.php?id=<?= $team->getId() ?>"> Modifier</a> |
                <a href="supprimer/supprimer_equipe.php?id=<?= $team->getId() ?>" onclick="return confirm('Supprimer cette équipe ?');"> Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Liste du personnel</h1>
    <a href="ajouter/ajouter_personnel.php"> Ajouter un membre du personnel</a>
    <table border="1" cellpadding="2">
        <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Rôle</th>
                <th>Photo</th>
        </tr>
        <?php foreach ($staff as $member): ?>
        <tr>
                <td><?= $member->getId() ?></td>
                <td><?= htmlspecialchars($member->getNom()) ?></td>
                <td><?= htmlspecialchars($member->getPrenom()) ?></td>
                <td><?= htmlspecialchars($member->getRole()) ?></td>
                <td>
                        <?php if (!empty($member->getPhoto())): ?>
                        <img src="<?= $member->getPhoto() ?>" width="50">
                        <?php else: ?>
                        -
                        <?php endif; ?>
                </td>
                <td>
                        <a href="modifier/modifier_personnel.php?id=<?= $member->getId() ?>"> Modifier</a> |
                        <a href="supprimer/supprimer_personnel.php?id=<?= $member->getId() ?>" onclick="return confirm('Supprimer ce membre du personnel ?');"> Supprimer</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php

include "../../src/includes/footer.php";

?>