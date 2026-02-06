<?php
require 'database.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE players SET name = :name, number = :number, position = :position WHERE id = :id");
    $stmt->execute([
        'id' => $_POST['player_id'],
        'name' => $_POST['player_name'],
        'number' => $_POST['player_number'],
        'position' => $_POST['player_position']
    ]);
    echo "Player edited!";
    echo '<p><a href="index.php">← Back to roster</a></p>';

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
    <title>Edit Player</title>
</head>

<body>
    <?php if (!$player): ?>
        <p>Player not found</p>
    <?php else: ?>
        <!-- Player Info -->
        <p>#<?= $player['number'] ?> - <?= $player['name'] ?></p>
        <p>Position: <?= $player['position'] ?></p>
        <!-- Edit Form -->
        <form action="edit-player.php" method="post">
            <input type="hidden" name="player_id" value="<?= $player['id'] ?>">
            <label for="player_name">Full name</label><br>
            <input type="text" name="player_name" value="<?= $player['name'] ?>"><br>
            <label for="player_number">Number</label><br>
            <input type="number" name="player_number" value="<?= $player['number'] ?>"><br>
            <label for="player_position">Position</label><br>
            <input type="text" name="player_position" value="<?= $player['position'] ?>"><br>
            <input type="submit" value="Edit Player">
        </form>
    <?php endif ?>
    <p><a href="index.php">← Back to roster</a></p>

</body>

</html>