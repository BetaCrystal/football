<?php

use App\PDO\JoueurPDO;

//FONCTION DE SUPPRESSION D'UN JOUEUR
function supprimerJoueur(PDO $pdo, int $id): bool
{
    $joueur = JoueurPDO::getById($pdo, $id); //VERIFICATION SI LE JOUEUR EXISTE
    if ($joueur)
    {
        JoueurPDO::delete($pdo, $id);

        return true;
    }

    return false;
}

//Récupérer l'ID du joueur à supprimer depuis l'URL
$id = $_GET['id'] ?? null;
if ($id && is_numeric($id))
    { //VERIFICATION SI L'ID EST VALIDE
    try {
        if (!supprimerJoueur($pdo, (int)$id))
        {
            echo "<p style='color:red'>Joueur introuvable.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>Erreur lors de la suppression : "
        .htmlspecialchars($e->getMessage())."</p>";
    }
}
