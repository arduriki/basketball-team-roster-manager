<?php
require 'database.php';

# To check if there's no id.
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
} else {
    $id = $_GET['id'];
}

# Statement to check if there's a player with the id.
$stmt = $pdo->prepare("SELECT * FROM players WHERE id = :id");
$stmt->execute(['id' => $id]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
</head>

<body>
    <?php if (!$player): ?>
        <p>Player not found</p>
    <?php else: ?>
        <p>#<?= $player['number'] ?> - <?= $player['name'] ?></p>
        <p>Position: <?= $player['position'] ?></p>
    <?php endif ?>
    <p><a href="index.php">← Back to roster</a></p>
</body>

</html>