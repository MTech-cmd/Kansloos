<?php

require_once('connector.php');

if (!isset($_GET['d'])) {
    die("Invalid request.");
}

$duelID = $_GET['d'];

// Fetch duel information
$query = "SELECT * FROM `Duel` WHERE `DuelID` = :id";
$prep = $pdo->prepare($query);
$prep->bindParam(':id', $duelID, PDO::PARAM_INT);
$prep->execute();
$duel = $prep->fetch(PDO::FETCH_ASSOC);

// Check if both players have made their choices
if (!empty($duel['OneInput']) && !empty($duel['TwoInput'])) {
    echo "both_selected";
} else {
    echo "waiting";
}
