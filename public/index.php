<?php

include "../src/includes/header.php";
require_once '../src/includes/Autoloader.php';
Autoloader::register();

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
    <a href="ajouter_joueur.php"> Ajouter un joueur</a>
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
            <td><?= $player->id ?></td>
            <td><?= htmlspecialchars($player->nom) ?></td>
            <td><?= htmlspecialchars($player->prenom) ?></td>
            <td><?= $player->dateNaissance->format('d/m/Y') ?></td>
            <td>
                <?php if (!empty($player->photo)): ?>
                    <img src="<?= $player->photo ?>" width="50">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td><?= App\PDO\AppartenancePDO::hasTeam($pdo, $player->id) ?></td>
            <td>
                <a href="modifier_joueur.php?id=<?= $player->id ?>"> Modifier</a> |
                <a href="supprimer_joueur.php?id=<?= $player->id ?>" onclick="return confirm('Supprimer ce joueur ?');"> Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Liste des équipes</h1>
    <a href="ajouter_equipe.php"> Ajouter une équipe</a>
    <table border="1" cellpadding="2">
        <tr>
                <th>ID</th>
                <th>Nom</th>
        </tr>
        <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= $team->id ?></td>
            <td><?= htmlspecialchars($team->nom) ?></td>
            <td>
                <a href="modifier_equipe.php?id=<?= $team->id ?>"> Modifier</a> |
                <a href="supprimer_equipe.php?id=<?= $team->id ?>" onclick="return confirm('Supprimer cette équipe ?');"> Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Liste du personnel</h1>
    <a href="ajouter_personnel.php"> Ajouter un membre du personnel</a>
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
                <td><?= $member->id ?></td>
                <td><?= htmlspecialchars($member->nom) ?></td>
                <td><?= htmlspecialchars($member->prenom) ?></td>
                <td><?= htmlspecialchars($member->role) ?></td>
                <td>
                        <?php if (!empty($member->photo)): ?>
                        <img src="<?= $member->photo ?>" width="50">
                        <?php else: ?>
                        -
                        <?php endif; ?>
                </td>
                <td>
                        <a href="modifier_personnel.php?id=<?= $member->id ?>"> Modifier</a> |
                        <a href="supprimer_personnel.php?id=<?= $member->id ?>" onclick="return confirm('Supprimer ce membre du personnel ?');"> Supprimer</a>
                </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php include "includes/footer.php"; ?>