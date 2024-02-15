<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

if (!isset($_SESSION['HeroID'])) {
    header("Location: mustlogin.html");
    die();
}

if (!isset($_GET['d'])) {
    header("Location: duel.php"); // Adjusted to the correct file
    die();
}

$duelID = $_GET['d'];

// Fetch duel information
$query = "SELECT * FROM `Duel` WHERE `DuelID` = :id";
$prep = $pdo->prepare($query);
$prep->bindParam(':id', $duelID, PDO::PARAM_INT);
$prep->execute();
$duel = $prep->fetch(PDO::FETCH_ASSOC);

if (!$duel || ($duel['OneID'] != $_SESSION['HeroID'] && $duel['TwoID'] != $_SESSION['HeroID'])) {
    // The player is not part of this duel
    header("Location: duel.php"); // Adjusted to the correct file
    die();
}

// Game logic function to determine the outcome
function determineOutcome($input1, $input2)
{
    if ($input1 == $input2) {
        return "It's a draw!";
    } elseif (
        ($input1 == '1' && $input2 == '3') ||
              ($input1 == '2' && $input2 == '1') ||
              ($input1 == '3' && $input2 == '2')
    ) {
        return "You win!";
    } else {
        return "You lose!";
    }
}

// If the form is submitted, update the player's choice in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playerChoice = $_POST['choice'];
    
    // Determine which input to update based on the logged-in user
    match ($_SESSION['HeroID']) {
        $duel['OneID'] => $updateField = 'OneInput',
        $duel['TwoID'] => $updateField = 'TwoInput',
        default => throw new Exception('Invalid user in duel')
    };
    
    $query = "UPDATE `Duel` SET `$updateField` = :choice WHERE `DuelID` = :id";
    $prep = $pdo->prepare($query);
    $prep->bindParam(':choice', $playerChoice, PDO::PARAM_STR);
    $prep->bindParam(':id', $duelID, PDO::PARAM_INT);
    $prep->execute();
    $prep->debugDumpParams();

    // Redirect to prevent form resubmission on refresh
    header("Location: duel.php?d=$duelID"); // Adjusted to the correct file
    die();
}

// Fetch updated duel information
$prep->execute();
$duel = $prep->fetch(PDO::FETCH_ASSOC);

// Check if both players have made their choices
if (!empty($duel['OneInput']) && !empty($duel['TwoInput'])) {
    // Determine the outcome
    $result = determineOutcome($duel['OneInput'], $duel['TwoInput']);
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors</title>
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>
    <h1>Rock Paper Scissors</h1>

    <?php if (!empty($result)) : ?>
        <h2><?php echo $result; ?></h2>
        <a href="duel.php">Play Again</a> <!-- Adjusted to the correct file -->
    <?php else : ?>
        <form method="post">
            <input type="hidden" name="DuelID" value="<?= $duelID; ?>">
            <label for="choice">Choose:</label>
            <select name="choice" id="choice">
                <option value="1">Rock</option>
                <option value="2">Paper</option>
                <option value="3">Scissors</option>
            </select>
            <button type="submit">Go!</button>
        </form>
        <p>Waiting for opponent to make a choice...</p>
        <p><a href="game.php?d=<?php echo $duelID; ?>">Refresh</a></p> <!-- Adjusted to the correct file -->
    <?php endif; ?>
</body>

</html>
