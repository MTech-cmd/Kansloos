<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

if (!isset($_SESSION['HeroID'])) {
    header("Location: mustlogin.html");
    die();
}

// Check if the player is already in a duel
$query = "SELECT * FROM `Duel` WHERE `OneID` = :id OR `TwoID` = :id";
$prep = $pdo->prepare($query);
$prep->bindParam(':id', $_SESSION['HeroID'], PDO::PARAM_INT);
$prep->execute();
$existingDuel = $prep->fetch(PDO::FETCH_ASSOC);

if ($existingDuel) {
    header("Location: game.php?d={$existingDuel['DuelID']}");
    die();
}

// Check if there are opponents in the queue
$query = "SELECT * FROM `Que` WHERE `HeroID` != :id";
$prep = $pdo->prepare($query);
$prep->bindParam(':id', $_SESSION['HeroID'], PDO::PARAM_INT);
$prep->execute();
$opponents = $prep->fetchAll(PDO::FETCH_ASSOC);

if ($opponents) {
    $opponentID = $opponents[0]['HeroID'];

    // Remove opponent from the queue
    $deleteQuery = "DELETE FROM `Que` WHERE `HeroID` = :id";
    $deletePrep = $pdo->prepare($deleteQuery);
    $deletePrep->bindParam(':id', $opponentID, PDO::PARAM_INT);
    $deletePrep->execute();

    // Insert a new duel entry
    $insertQuery = "INSERT INTO `Duel` (`OneID`, `TwoID`) VALUES (:one, :two)";
    $insertPrep = $pdo->prepare($insertQuery);
    $insertPrep->bindParam(':one', $_SESSION['HeroID'], PDO::PARAM_INT);
    $insertPrep->bindParam(':two', $opponentID, PDO::PARAM_INT);
    $insertPrep->execute();
    $duelID = intval($pdo->lastInsertId());

    // Redirect both players to the game page for the new duel
    header("Location: game.php?d={$duelID}");
    die();
}

// If no opponents in the queue, add the player to the queue
$insertQuery = "INSERT INTO `Que` (HeroID) VALUES (:id)";
$insertPrep = $pdo->prepare($insertQuery);
$insertPrep->bindParam(':id', $_SESSION['HeroID'], PDO::PARAM_INT);
$insertPrep->execute();

// Redirect to keep refreshing until a duel is initiated
header("Refresh: 5");
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Que</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/font.css">
    <script>
        function reloadPage() { location.reload(); }
        setInterval(reloadPage, 5000);
    </script>
</head>

<body>
    You are in QUE.
</body>

</html>
