<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

function sendToDB($query, $params, $pdo)
{
    $prep = $pdo->prepare($query);
    foreach ($params as $k => &$v) {
        $prep->bindParam($k, $v);
    }
    $prep->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "INSERT INTO `Accounts` (`HeroID`, `Username`, `Password`, `RecoveryEmail`) VALUES
    (:id, :username, :password, :email)";

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $params = array(
        ':id' => $_SESSION['HeroID'],
        ':username' => $_POST['username'],
        ':password' => $password,
        ':email' => $_POST['email']
    );

    sendToDB($query, $params, $pdo);

    header("Location: logout.php");
    die();
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Log in</title>
    <link rel="stylesheet" href="styling/font.css">
    <link rel="stylesheet" href="styling/form.css">
</head>

<body>

    <header style="background-color: #000; height: 50px;">
    </header>

    <section class="cyberpunk">
        <h1>Make sure to create an account!</h1>
    </section>

    <section class="cyberpunk black">
        <form action="signup.php" method="POST">

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <input class="cyberpunk green" type="submit" value="Create Account">

        </form>
    </section>

    <footer style="background-color: #000; height: 50px;"></footer>

</body>

</html>