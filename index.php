<?php
require_once "includes/db.php";
require_once "equipe.php";
require_once "joueur.php";

// Récupérer les joueurs
$players = Joueur::getAll($pdo);

var_dump($players);

// Récupérer les équipes
$teams = Equipe::getAll($pdo);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
</head>
<body>
    <h1>Liste des joueurs</h1>
    <a href="ajouter_joueur.php"> Ajouter un joueur</a>
    <table border="1" cellpadding="8"> <?php // tableau css pour la présentation/c'est les catégories?>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Photo</th>
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
</body>
</html>
