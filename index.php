<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Roster</title>
</head>

<body>
    <h1>Basketball Roster Manager</h1>

    <?= "<p>This part comes from PHP!</p>" ?>

    <?php
    $players = [
        [
            "name" => "Dario Brizuela",
            "number" => 8,
            "position" => "Guard",
        ],
        [
            "name" => "Tornike Shengelia",
            "number" => 23,
            "position" => "Guard",
        ],
        [
            "name" => "Joel Parra",
            "number" => 44,
            "position" => "Forward",
        ]
    ];
    ?>
    <ul>
        <?php
        foreach ($players as $player) {
            echo "<li>#{$player["number"]} - {$player["name"]} ({$player["position"]})</li>";
        }
        ?>
    </ul>



</body>

</html>