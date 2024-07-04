<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

$isLoggedIn = isset($_SESSION['user_id']);

try {
    $query_board = "SELECT `HeroId`, `FirstName`, `Alias`, `Picture`, `ELO`, `Rank` FROM `Profiles` ORDER BY `ELO` DESC";
    $stmt_board = $pdo->query($query_board);
    $result_board = $stmt_board->fetchAll();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Leaderboard</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/leaderboard.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">HOME</a>
        <a href="duel.php">DUEL</a>
        <a href="leaderboard.php">LEADERBOARD</a>
        <?php if ($isLoggedIn) : ?>
            <a class="cyberpunk red" href="?logout=true">LOGOUT</a>
        <?php else : ?>
            <a class="cyberpunk green" href="login.php">LOGIN</a>
            <a class="cyberpunk blue" href="register.php">REGISTER</a>
        <?php endif; ?>
    </div>

    <header style="background-color: #000; height: 50px;">
        <span onclick="openNav()" style="display: flex; margin-left: 30px;">
            <img src="images/favicon.png" alt="logo" width="40">
            <a style="color: #0ff2f2; font-size: 2rem; margin-left: 10px;">Hero Association</a>
        </span>
    </header>

    <section class="cyberpunk">
        <h1 class="cyberpunk glitched">Leaderboard</h1>
    </section>

    <section class="cyberpunk black both">
        <div class="carousel">
            <?php
            foreach ($result_board as $i => $player) {
                $placeImage = '';
                if ($i === 0) {
                    $placeImage = 'images/place-1.png';
                } elseif ($i === 1) {
                    $placeImage = 'images/place-2.png';
                } elseif ($i === 2) {
                    $placeImage = 'images/place-3.png';
                }
                ?>
                <div class="player-card<?php echo $i === 0 ? ' active' : ''; ?>" id="player_<?php echo $i; ?>">
                    <div class="row">
                        <div class="column">
                            <div class="player-image-container">
                                <img src="<?php echo $player['Picture'] ? $player['Picture'] : 'default.jpg'; ?>" alt="<?php echo $player['FirstName']; ?>" class="player-image">
                            </div>
                        </div>
                        <div class="column">
                            <h2><?php echo $player['Alias']; ?></h2>
                            <div class="player-details">
                                <div class="row">
                                    <div class="column">
                                        <?php if ($i < 3) : ?>
                                            <img src="<?php echo $placeImage; ?>" alt="<?php echo $player['Alias'] . ' - ' . ($i + 1) . 'e plaats'; ?>" class="place-image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="column">
                                        <p>ELO: <?php echo $player['ELO']; ?></p>
                                    </div>
                                    <div class="column">
                                        <p>Rank: <?php echo $player['Rank']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="navigation-buttons">
                <?php if (count($result_board) > 1) : ?>
                    <button class="cyberpunk blue<?php echo $i === 0 ? ' hidden' : ''; ?>" onclick="showPrevious()">
                        &lt;=
                    </button>
                    <button class="cyberpunk blue<?php echo $i === count($result_board) - 1 ? ' hidden' : ''; ?>" onclick="showNext()">
                        =&gt;
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="javascript/leaderboard.js"></script>

</body>

</html>
