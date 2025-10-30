<?php

require __DIR__."/../includes/header.php";

use App\PDO\JoueurPDO;

$id = $_GET['id'] ?? null;
if (!$id)
{
    die("ID manquant");
}

// Récupérer joueur
$player = JoueurPDO::getById($pdo, $id);

if (!$player)
{
    die("Joueur introuvable");
}

//VALIDATIION FORMULAIRE + MISE A JOUR DANS LA BASE DE DONNEES
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nom = $_POST['prenom'] ?? '';
    $prenom = $_POST['nom'] ?? '';
    $dateNaissance = $_POST['birth_date'] ?? '';
    $photo = $_POST['photo'] ?? '';
    $d = DateTime::createFromFormat('Y-m-d', $dateNaissance);
    $isValidDate = $d && $d->format('Y-m-d') === $dateNaissance;
    if (!empty($nom) && !empty($prenom) && $isValidDate) {
        $nouvJoueur = new App\Classes\Joueur($id, $nom, $prenom, new DateTime($dateNaissance), $photo);
        if (JoueurPDO::update($pdo, $nouvJoueur))
        {
            header("Location: ../../public/index.php");
            exit;
        } else {
            echo "<p style='color:red'>Erreur lors de la mise à jour.</p>";
        }
    } else {
        echo "<p style='color:red'>Données invalides. Veuillez vérifier les champs.</p>";
    }
}
