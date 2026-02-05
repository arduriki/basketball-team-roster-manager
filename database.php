<?php

$dsn = "mysql:host=127.0.0.1;port=3306;dbname=basketball_roster";
$username = "root";
$password = "secret";

$pdo = new PDO($dsn, $username, $password);

$result = $pdo->query("SELECT * FROM players");
$players = $result->fetchAll(PDO::FETCH_ASSOC);