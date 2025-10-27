<?php

require __DIR__."/../../src/add/ajouter_joueur.php";

?>

    <h1>Ajouter un joueur</h1>
    <form method="post">
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label>Nom :</label>
        <input type="text" name="nom" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birth_date"><br>

        <label>Photo (URL) :</label>
        <input type="text" name="picture"><br><br>

        <button type="submit">Ajouter</button>
    </form>

<?php

include "../../src/includes/footer.php";

?>