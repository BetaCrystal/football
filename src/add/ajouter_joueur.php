<?php

require __DIR__."/../includes/header.php";

use App\PDO\JoueurPDO;

$id = null;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nouvJoueur = new App\Classes\Joueur($id, $_POST['nom'], $_POST['prenom'], new DateTime($_POST['birth_date']), $_POST['picture']);
    JoueurPDO::create($pdo, $nouvJoueur);
    header("Location: ../../public/index.php");
    exit;
}
