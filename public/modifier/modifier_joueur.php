<?php

require __DIR__."/../../src/update/modifier_joueur.php";

?>

<h1>Modifier joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($player->getPrenom()) ?>" required><br>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($player->getNom()) ?>" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birth_date" value="<?= $player->getDateNaissance()->format('Y-m-d') ?>" required><br>

        <label>Photo (URL) :</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($player->getPhoto()) ?>"><br><br>

        <button type="submit">Enregistrer</button>
    </form>

<?php

include "../../src/includes/footer.php";

?>