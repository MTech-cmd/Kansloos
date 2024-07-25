<?php

session_start();

require_once('lemmino.php');
require_once('connector.php');

$query = "SELECT * FROM `Duel` WHERE `DuelID` = :id";
$prep = $pdo->prepare($query);
$prep->bindParam(':id', $_GET['d'], PDO::PARAM_INT);
$prep->execute();
$meta = $prep->fetch(PDO::FETCH_ASSOC);

$newEloRatings = [];

// Check if ELO calculation has already been performed
if ($meta['Temp'] != 1) {
    function calculateNewElo($ratingPlayer1, $ratingPlayer2, $result)
    {
        // Define K-factor (adjusts the sensitivity of the Elo rating change)
        $K = 32; // You can adjust this value based on your requirements

        // Calculate expected scores
        $expectedScorePlayer1 = 1 / (1 + pow(10, ($ratingPlayer2 - $ratingPlayer1) / 400));
        $expectedScorePlayer2 = 1 - $expectedScorePlayer1;

        // Calculate actual scores
        if ($result == 1) {
            $actualScorePlayer1 = 1;
            $actualScorePlayer2 = 0;
        } elseif ($result == 2) {
            $actualScorePlayer1 = 0;
            $actualScorePlayer2 = 1;
        } else {
            // Draw
            $actualScorePlayer1 = 0.5;
            $actualScorePlayer2 = 0.5;
        }

        // Calculate new ratings
        $newRatingPlayer1 = $ratingPlayer1 + $K * ($actualScorePlayer1 - $expectedScorePlayer1);
        $newRatingPlayer2 = $ratingPlayer2 + $K * ($actualScorePlayer2 - $expectedScorePlayer2);

        // Return new ratings
        return array($newRatingPlayer1, $newRatingPlayer2);
    }

    // Fetch current Elo ratings of both players along with additional profile data
    $queryEloPlayer1 = "SELECT `HeroID`, `FirstName`, `LastName`, `ELO`, `Rank` FROM `Profiles` WHERE `HeroID` = :id";
    $prepEloPlayer1 = $pdo->prepare($queryEloPlayer1);
    $prepEloPlayer1->bindParam(':id', $meta['OneID'], PDO::PARAM_INT);
    $prepEloPlayer1->execute();
    $eloPlayer1 = $prepEloPlayer1->fetch(PDO::FETCH_ASSOC);

    $queryEloPlayer2 = "SELECT `HeroID`, `FirstName`, `LastName`, `ELO`, `Rank` FROM `Profiles` WHERE `HeroID` = :id";
    $prepEloPlayer2 = $pdo->prepare($queryEloPlayer2);
    $prepEloPlayer2->bindParam(':id', $meta['TwoID'], PDO::PARAM_INT);
    $prepEloPlayer2->execute();
    $eloPlayer2 = $prepEloPlayer2->fetch(PDO::FETCH_ASSOC);

    // Calculate new Elo ratings
    $newEloRatings = calculateNewElo($eloPlayer1['ELO'], $eloPlayer2['ELO'], $meta['Winner']);

    // Update Elo ratings in the database
    $updateQueryPlayer1 = "UPDATE `Profiles` SET `ELO` = :elo WHERE `HeroID` = :id";
    $updatePrepPlayer1 = $pdo->prepare($updateQueryPlayer1);
    $updatePrepPlayer1->bindParam(':elo', $newEloRatings[0], PDO::PARAM_INT);
    $updatePrepPlayer1->bindParam(':id', $meta['OneID'], PDO::PARAM_INT);
    $updatePrepPlayer1->execute();

    $updateQueryPlayer2 = "UPDATE `Profiles` SET `ELO` = :elo WHERE `HeroID` = :id";
    $updatePrepPlayer2 = $pdo->prepare($updateQueryPlayer2);
    $updatePrepPlayer2->bindParam(':elo', $newEloRatings[1], PDO::PARAM_INT);
    $updatePrepPlayer2->bindParam(':id', $meta['TwoID'], PDO::PARAM_INT);
    $updatePrepPlayer2->execute();

    // Update the Temp column in the Duel table to indicate that the update has been applied
    $updateQueryTemp = "UPDATE `Duel` SET `Temp` = 1 WHERE `DuelID` = :id";
    $updatePrepTemp = $pdo->prepare($updateQueryTemp);
    $updatePrepTemp->bindParam(':id', $_GET['d'], PDO::PARAM_INT);
    $updatePrepTemp->execute();
} else {
    // Fetch current Elo ratings of both players along with additional profile data
    $queryEloPlayer1 = "SELECT `HeroID`, `FirstName`, `LastName`, `ELO`, `Rank` FROM `Profiles` WHERE `HeroID` = :id";
    $prepEloPlayer1 = $pdo->prepare($queryEloPlayer1);
    $prepEloPlayer1->bindParam(':id', $meta['OneID'], PDO::PARAM_INT);
    $prepEloPlayer1->execute();
    $eloPlayer1 = $prepEloPlayer1->fetch(PDO::FETCH_ASSOC);

    $queryEloPlayer2 = "SELECT `HeroID`, `FirstName`, `LastName`, `ELO`, `Rank` FROM `Profiles` WHERE `HeroID` = :id";
    $prepEloPlayer2 = $pdo->prepare($queryEloPlayer2);
    $prepEloPlayer2->bindParam(':id', $meta['TwoID'], PDO::PARAM_INT);
    $prepEloPlayer2->execute();
    $eloPlayer2 = $prepEloPlayer2->fetch(PDO::FETCH_ASSOC);

    // Use the existing ELO ratings
    $newEloRatings = array($eloPlayer1['ELO'], $eloPlayer2['ELO']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <meta name="description" content="A website we made for a Bit Academy Deep Dive about One Punch Man.">
    <title>Result</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/index.css">
    <link rel="stylesheet" href="styling/font.css">
</head>
<body>
    <section class="cyberpunk both black">

        <h2>Player 1</h2>
        <p>Name: <?php echo $eloPlayer1['FirstName'] . ' ' . $eloPlayer1['LastName']; ?></p>
        <p>ELO: <?php echo $newEloRatings[0]; ?></p>
        <p>Rank: <?php echo $eloPlayer1['Rank']; ?></p>
    </section>
    <section class="cyberpunk both black">

        <h2>Player 2</h2>
        <p>Name: <?php echo $eloPlayer2['FirstName'] . ' ' . $eloPlayer2['LastName']; ?></p>
        <p>ELO: <?php echo $newEloRatings[1]; ?></p>
        <p>Rank: <?php echo $eloPlayer2['Rank']; ?></p>
    </section>

    <section class="cyberpunk both black">
        <h2>Winner</h2>
        <?php
        if ($meta['Winner'] == 1) {
            echo "<p>The winner is: {$eloPlayer1['FirstName']} {$eloPlayer1['LastName']}</p>";
        } elseif ($meta['Winner'] == 2) {
            echo "<p>The winner is: {$eloPlayer2['FirstName']} {$eloPlayer2['LastName']}</p>";
        } else {
            echo "<p>No winner declared</p>";
        }
        ?>
    </section>

    <!-- Script to trigger deletion asynchronously -->
    <script>
        // Function to trigger deletion
        function deleteDuel() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "delete.php?d=<?php echo $_GET['d']; ?>", true);
            xhr.send();
        }

        // Trigger deletion after 5 seconds
        setTimeout(deleteDuel, 5000); // 5 seconds delay
    </script>
</body>
</html>

