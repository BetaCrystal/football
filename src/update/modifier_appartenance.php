<?php

require __DIR__."/../includes/header.php";

use App\PDO\AppartenancePDO;
use App\PDO\EquipePDO;

$playerId = isset($_GET['player_id']) ? (int)$_GET['player_id'] : null;
$teamId = isset($_GET['team_id']) ? (int)$_GET['team_id'] : null;

if (!$playerId || !$teamId) {
	die('Paramètres manquants');
}

$appartenance = AppartenancePDO::getById($pdo, $playerId, $teamId);
if (!$appartenance) {
	die('Appartenance introuvable');
}

$equipes = EquipePDO::getAll($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$newTeamId = (int)($_POST['equipe_id'] ?? $teamId);
	$role = trim((string)($_POST['role'] ?? $appartenance->getRole()));
	if (AppartenancePDO::update($pdo, $playerId, $teamId, $newTeamId, $role)) {
		header("Location: ../../public/afficher_appartenances.php?id={$playerId}");
		exit;
	} else {
		echo "<p style='color:red'>Erreur lors de la mise à jour.</p>";
	}
}

?>

<h1>Modifier l'appartenance de <?= htmlspecialchars($appartenance->joueur->getNom()) ?></h1>
<form method="post" action="">
	<label for="equipe">Equipe :</label>
	<select name="equipe_id" id="equipe">
		<?php foreach ($equipes as $e): ?>
			<option value="<?= $e->getId() ?>" <?= ($e->getId() === $appartenance->equipe->getId()) ? 'selected' : '' ?>><?= htmlspecialchars($e->getNom()) ?></option>
		<?php endforeach; ?>
	</select>

	<label for="role">Rôle :</label>
	<select name="role" id="role" required>
		<?php $currentRole = $appartenance->getRole(); ?>
		<option value="attaquant" <?= $currentRole === 'attaquant' ? 'selected' : '' ?>>Attaquant</option>
		<option value="milieu" <?= $currentRole === 'milieu' ? 'selected' : '' ?>>Milieu</option>
		<option value="défenseur" <?= $currentRole === 'défenseur' ? 'selected' : '' ?>>Défenseur</option>
		<option value="gardien" <?= $currentRole === 'gardien' ? 'selected' : '' ?>>Gardien</option>
	</select>

	<button type="submit">Mettre à jour</button>
</form>

