<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

$isLoggedIn = isset($_SESSION['AdminID']) || isset($_SESSION['HeroID']);


try {
    if (isset($_GET['logout'])) {
        header("Location: logout.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_SESSION['HeroID']) || !(isset($_GET['q']))) {
    $query = "SELECT FirstName, LastName, Alias, Picture, BirthDate, ELO, Rank FROM Profiles ORDER BY RAND() LIMIT 10";
    $stmt = $pdo->query($query);
    $heroes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($isLoggedIn) {
        $query_main = "SELECT FirstName, LastName, Alias, Picture, BirthDate, ELO, Rank FROM Profiles WHERE HeroID = ?";
        $stmt_main = $pdo->prepare($query_main);
        $stmt_main->execute([$_SESSION['HeroID']]);
        $main_hero = $stmt_main->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $query = "SELECT FirstName, LastName, Alias, Picture, BirthDate, ELO, Rank FROM Profiles ORDER BY RAND() LIMIT 11";
    $stmt = $pdo->query($query);
    $heroes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Felix Huel, Mehdi El Khallouki">
  <title>The Hero Association</title>
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
    <h1 class="cyberpunk glitched">Hero Dex</h1>
  </section>

  <section class="cyberpunk black both">
    <h1 class="cyberpunk">First Name + Last Name</h1>
    <h2 class="cyberpunk">Alias + Birth Date</h2>
    <h2 class="cyberpunk">ELO</h2>

    <div class="row">
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/400x500/ff00ff/fff" alt="">
      </div>
      <div class="column smaller">
        <img class="cyberpunk" src="https://dummyimage.com/150x150/ff00ff/fff" alt="">
      </div>
      <div class="column text">
        <p class="cyberpunk">Origin Story</p>
        <p class="cyberpunk">Motivation</p>
      </div>
    </div>

  </section>

  <section class="cyberpunk both">
    <div class="row center">
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
    </div>
    <br>
    <div class="row center">
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
      <div class="column">
        <img class="cyberpunk" src="https://dummyimage.com/200x300/ff00ff/fff" alt="" />
      </div>
    </div>
  </section>

  <footer style="background-color: #000; height: 50px;"></footer>

  <script src="javascript/main.js"></script>
</body>

</html>
