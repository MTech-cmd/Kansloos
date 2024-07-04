<?php

require_once('connector.php');

// Delayed deletion from the Duel table
sleep(5); // Delay for 5 seconds

$duelID = $_GET['d'];

$updateQuery = "UPDATE `Duel` SET `OneID` = NULL, `TwoID` = NULL WHERE `DuelID` = :id";
$updatePrep = $pdo->prepare($updateQuery);
$updatePrep->bindParam(':id', $duelID, PDO::PARAM_INT);
$updatePrep->execute();

