<?php

require __DIR__ . "/../includes/header.php";

use App\PDO\EquipePDO;


function supprimerEquipe(PDO $pdo, int $id): bool
{
    $equipe = EquipePDO::getById($pdo, $id);
    if ($equipe) {
        EquipePDO::delete($pdo, $equipe);

        return true;
    }

    return false;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== null && $id !== false) {
    try {
        if (!supprimerEquipe($pdo, (int)$id)) {

        }
    } catch (PDOException $e) {

    }
}

// Revenir à la page INDEX.PHP
header("Location: ../../public/index.php");
exit;
