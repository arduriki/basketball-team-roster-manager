<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO players (name, number, position) VALUES (:name, :number, :position)");
    $stmt->execute([
        'name' => $_POST['player_name'],
        'number' => $_POST['player_number'],
        'position' => $_POST['player_position']
    ]);
    echo "Player added!";
    echo '<p><a href="index.php">← Back to roster</a></p>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
</head>

<body>
    <h1>Add new player</h1>

    <form action="add-player.php" method="post">
        <label for="player_name">Full name</label><br>
        <input type="text" name="player_name"><br>
        <label for="player_number">Number</label><br>
        <input type="number" name="player_number"><br>
        <label for="player_position">Position</label><br>
        <input type="text" name="player_position"><br>
        <input type="submit" value="Add Player">
    </form>
</body>

</html>