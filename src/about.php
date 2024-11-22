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
    <meta name="description" content="A website we made for a Bit Academy Deep Dive about One Punch Man">
    <title>About</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/about.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">HOME</a>
        <a href="duel.php">DUEL</a>
        <a href="leaderboard.php">LEADERBOARD</a>
        <a href="https://github.com/MTech-cmd/Kansloos">SOURCE CODE</a>
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
        <article class="descriptor">
            <p>text</p>
            <img src="https://storage.googleapis.com/pod_public/1300/182337.jpg" alt="Felix Huel" width="300">
        </article>
        <h1>Mehdi El Khallouki</h1>
        <article class="descriptor">
            <p>Hi! I'm Mehdi and I'm a Full-stack Developer at the Bit Academy.
                I've always been a tech nerd and enjoy expanding my knowledge in the world of IT! You can find my other projects at my GitHub and portfolio page!<br>
                <a href="https://github.com/MTech-cmd"><img src="https://storage.googleapis.com/pod_public/1300/182337.jpg" alt="GitHub" width="50"></a>
                <a href="https://mtech-cmd.github.io/"><img src="https://storage.googleapis.com/pod_public/1300/182337.jpg" alt="MTech" width="50"></a>
                <a href="https://linkedin.com/in/mehdi-el-khallouki"><img src="https://storage.googleapis.com/pod_public/1300/182337.jpg" alt="LinkedIn" width="50"></a>
            </p>
            <img src="https://storage.googleapis.com/pod_public/1300/182337.jpg" alt="Mehdi El Khallouki" width="300">
        </article>
    </section>

    <script src="javascript/main.js"></script>

</body>

</html>
