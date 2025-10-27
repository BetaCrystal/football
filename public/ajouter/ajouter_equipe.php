<?php

require __DIR__."/../../src/add/ajouter_equipe.php";

?>

<form method="post" action="">
    <label>Nom de l'équipe :</label>
    <input type="text" name="nom"><br><br>
    <button type="submit">Ajouter</button>
</form>

<?php

include "../../src/includes/footer.php";

?>