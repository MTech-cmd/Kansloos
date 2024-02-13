<?php

function ELO($winnerELO, $loserELO, $kFactor = 32)
{
    $winnerScore = 1 / (1 + pow(10, ($loserELO - $winnerELO) / 400));
    $newWinnerELO = $winnerELO + $kFactor * (1 - $winnerScore);
    $newLoserELO = $loserELO + $kFactor * (0 - (1 - $winnerScore));
    return [$newWinnerELO, $newLoserELO];
}