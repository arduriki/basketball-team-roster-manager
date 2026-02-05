<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Roster</title>
</head>

<body>
    <h1>Basketball Roster Manager</h1>

    <?= "<h2>FC Barcelona Roster</h2>" ?>

    <ul>
        <?php
        foreach ($players as $player) {
            echo "<li>#{$player["number"]} - {$player["name"]} ({$player["position"]})</li>";
        }
        ?>
    </ul>

</body>

</html>