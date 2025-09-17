<?php
require_once "includes/db.php";

// Récupérer les joueurs
$stmt = $pdo->query("SELECT * FROM player ORDER BY last_name ASC");
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <td><?= $player['id'] ?></td>
            <td><?= htmlspecialchars($player['last_name']) ?></td>
            <td><?= htmlspecialchars($player['first_name']) ?></td>
            <td><?= $player['birth_date'] ?></td>
            <td>
                <?php if (!empty($player['picture'])): ?>
                    <img src="<?= $player['picture'] ?>" width="50">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <a href="modifier_joueur.php?id=<?= $player['id'] ?>"> Modifier</a> | 
                <a href="supprimer_joueur.php?id=<?= $player['id'] ?>" onclick="return confirm('Supprimer ce joueur ?');"> Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
