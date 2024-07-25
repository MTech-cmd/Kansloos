<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query_login = "SELECT `AdminID`, `HeroID`, Password FROM `Accounts` WHERE `Username` = ?";
    $stmt_login = $pdo->prepare($query_login);
    $stmt_login->execute([$username]);
    $user = $stmt_login->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['AdminID'] = $user['AdminID'] ?? null;
        $_SESSION['HeroID'] = $user['HeroID'] ?? null;
        header("Location: index.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <meta name="description" content="A website we made for a Bit Academy Deep Dive about One Punch Man.">
    <title>Log in</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/login.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>
    <header style="background-color: #000; height: 50px;"><img src="images/" alt="logo">
    </header>

    <section class="cyberpunk">
        <h1 class="cyberpunk glitched">Log In</h1>

    </section>

    <section class="cyberpunk black both">
        <form method="post" class="form">
            <?php if (isset($loginError)) {
                echo '<p style="color: red;">' . $loginError . '</p>';
            } ?>
            <label for="username" class="cyberpunk">Username:</label>
            <input type="text" name="username" placeholder="Username" class="cyberpunk" required>
            <br>
            <br>
            <br>
            <label for="password" class="cyberpunk">Password:</label>
            <input type="password" name="password" placeholder="Password" class="cyberpunk" required>
            <br>
            <br>
            <div class="container">
                <button type="submit" value="LOGIN" name="login" class="cyberpunk blue">
                    LOGIN
                </button>
            </div>
        </form>
    </section>

    <footer style="background-color: #000; height: 170px;"></footer>


</body>

</html>
