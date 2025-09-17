<?php
require_once "includes/db.php";

$id = $_GET['id'] ?? null; //supprimer un joueur par son ID
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM player WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
