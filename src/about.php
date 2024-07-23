<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>About</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">HOME</a>
        <a href="duel.php">DUEL</a>
        <a href="leaderboard.php">LEADERBOARD</a>
        <a href="about.php">ABOUT</a>
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

    <section class="cyberpunk both">
        <h1 class="cyberpunk glitched">About</h1>
    </section>

    <section class="cyberpunk black center">
        <h1>Felix Huel</h1>
    </section>

    <script src="javascript/main.js"></script>

</body>

</html>
