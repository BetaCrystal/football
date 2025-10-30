<?php

require __DIR__."/../../src/update/modifier_personnel.php";

?>

<h1>Modifier le personnel</h1>
<form method="post" action="">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($staff->getPrenom()) ?>"><br>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($staff->getNom()) ?>"><br>

        <label>Rôle :</label>
        <input type="text" name="role" value="<?= htmlspecialchars($staff->getRole()) ?>"><br>

        <label>Photo (URL) :</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($staff->getPhoto()) ?>"><br><br>

        <button type="submit">Enregistrer</button>
</form>

<?php

require __DIR__. "/../../src/includes/footer.php";

?>