<?php
function getId()
{
    # To check if there's no id.
    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit;
    } else {
        return $_GET['id'];
    }
}

function checkIdPlayer($pdo, $id)
{
    # Statement to check if there's a player with the id.
    $stmt = $pdo->prepare("SELECT * FROM players WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}