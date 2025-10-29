<?php

require __DIR__ . "/../includes/header.php";

use App\PDO\EquipePDO;

// FONCTION DE SUPPRESSION D'UNE ÉQUIPE
function supprimerEquipe(PDO $pdo, int $id): bool
{
    $equipe = EquipePDO::getById($pdo, $id); // VÉRIFICATION SI EXISTE
    if ($equipe)
    {
        EquipePDO::delete($pdo, $equipe);
        return true;
    }

    return false;
}

// Récupérer l'ID depuis l'URL
$id = $_GET['id'] ?? null;
if ($id && is_numeric($id))
    {
    try {
        if (!supprimerEquipe($pdo, (int)$id))
        {
            echo "<p style='color:red'>Équipe introuvable.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>Erreur lors de la suppression : "
            . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

header("Location: ../../public/index.php");
exit;