<?php

require __DIR__ . "/../includes/header.php";

use App\PDO\PersonnelPDO;

// FONCTION DE SUPPRESSION D'UN MEMBRE DU PERSONNEL
function supprimerPersonnel(PDO $pdo, int $id): bool
{
    $personnel = PersonnelPDO::getById($pdo, $id); // VÉRIFICATION SI EXISTE
    if ($personnel)
    {
        PersonnelPDO::delete($pdo, $personnel);

        return true;
    }

    return false;
}

// Récupérer l'ID depuis l'URL
$id = $_GET['id'] ?? null;
if ($id && is_numeric($id))
    {
    try {
        if (!supprimerPersonnel($pdo, (int)$id))
        {
            echo "<p style='color:red'>Membre du personnel introuvable.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>Erreur lors de la suppression : "
            . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

header("Location: ../../public/index.php");
exit;