<?php

require __DIR__."/../../src/update/modifier_equipe.php";

?>

<h1>Modifier une équipe</h1>
<form method="post" action="">
        <label>Nom de l'équipe :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($team->getNom()) ?>"><br><br>
        <button type="submit">Enregistrer</button>
</form>

<?php

require __DIR__. "/../../src/includes/footer.php";

?>