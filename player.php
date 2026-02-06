<?php
require 'database.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM players WHERE id = :id");
    $stmt->execute([
        'id' => $_POST['player_id'],
    ]);

    header('Location: index.php');

    die();
}

$id = getId();
$player = checkIdPlayer($pdo, $id);
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
        <p><a href="edit-player.php?id=<?= $player['id'] ?>">Edit Player →</a></p>
        <form action="player.php" method="post">
            <input type="hidden" name="player_id" value="<?= $player['id'] ?>">
            <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
        </form>
    <?php endif ?>
    <p><a href="index.php">← Back to roster</a></p>
</body>

</html>