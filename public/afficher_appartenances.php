<?php

require __DIR__."/../src/afficher_appartenances.php";

?>

<h1>Equipes du joueur</h1>
<a href="ajouter/ajouter_appartenance.php?id=<?php echo $_GET['id']?>">Ajouter une appartenance</a>
<table border="1" cellpadding="2">
    <tr>
        <th>ID équipe</th>
        <th>Nom équipe</th>
        <th>Rôle</th>
    </tr>
    <?php foreach ($appartenances as $appartenance): ?>
    <tr>
        <td><?= htmlspecialchars($appartenance->$equipe->getId()) ?></td>
        <td><?= htmlspecialchars($appartenance->$equipe->getNom()) ?></td>
        <td><?= htmlspecialchars($appartenance->getRole()) ?></td>
        <td>
            <a href="modifier/modifier_appartenance.php?player_id=<?= $appartenance->getJoueur()->getId() ?>&team_id=<?= $appartenance->getEquipe()->getId() ?>"> Modifier</a> |
            <a href="supprimer/supprimer_appartenance.php?player_id=<?= $appartenance->getJoueur()->getId() ?>&team_id=<?= $appartenance->getEquipe()->getId() ?>" onclick="return confirm('Supprimer cette appartenance ?');"> Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>