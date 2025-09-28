<?php

include "includes/db.php";
include "includes/header.php";
require_once "classes/Personnel.php";

//On récupère le personnel par son ID
$staff = Personnel::getById($pdo, $_GET['id']);

if (!$staff) {
    die("Personnel introuvable");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["role"])) {
        $sql = "UPDATE staff_member SET last_name = :nom, first_name = :prenom, role = :role, picture = :photo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':role' => $_POST['role'],
            ':photo' => $photo,
            ':id' => $staff->id
        ]);
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red'>Données invalides. Veuillez vérifier les champs.</p>";
    }
}

?>
<h1>Modifier le personnel</h1>
<form method="post" action="">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($staff->prenom) ?>"><br>

        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($staff->nom) ?>"><br>

        <label>Rôle :</label>
        <input type="text" name="role" value="<?= htmlspecialchars($staff->role) ?>"><br>

        <label>Photo (URL) :</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($staff->photo) ?>"><br><br>

        <button type="submit">Enregistrer</button>
</form>


<?php
include "includes/footer.php";
?>
