<?php

require __DIR__."/../includes/header.php";

use App\PDO\AppartenancePDO;

// Vérification des paramètres requis
if (!isset($_GET['player_id']) || !isset($_GET['team_id'])) {
	die('Paramètres manquants');
}

$playerId = (int) $_GET['player_id'];
$teamId = (int) $_GET['team_id'];

try {
	$deleted = AppartenancePDO::delete($pdo, $playerId, $teamId);
	if ($deleted > 0) {
		header("Location: ../../public/afficher_appartenances.php?id={$playerId}");
		exit;
	} else {
		echo "<p style='color:red'>Aucune appartenance trouvée à supprimer pour player_id={$playerId} et team_id={$teamId}.</p>";
		echo "<p><a href='../../public/afficher_appartenances.php?id={$playerId}'>Retour</a></p>";
		exit;
	}
} catch (\Exception $e) {
	echo "<p style='color:red'>Erreur lors de la suppression : " . htmlspecialchars($e->getMessage()) . "</p>";
	echo "<p><a href='../../public/afficher_appartenances.php?id={$playerId}'>Retour</a></p>";
	exit;
}
