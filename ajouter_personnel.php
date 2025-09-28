<?php
include "includes/db.php";
include "includes/header.php";
require_once "classes/Personnel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        Personnel::create($pdo, $_POST['nom'], $_POST['prenom'], $_POST['photo'], $_POST['role']);
    header("Location: index.php");
    exit;
}

?>

        <h1>Ajouter un personnel</h1>
        <form method="post">
                <label>Prénom :</label>
                <input type="text" name="prenom" required><br>

                <label>Nom :</label>
                <input type="text" name="nom" required><br>

                <label>Photo (URL) :</label>
                <input type="text" name="photo"><br>

                <label>Rôle :</label>
                <input type="text" name="role"><br><br>

                <button type="submit">Ajouter</button>
        </form>
<?php
include "includes/footer.php";?>