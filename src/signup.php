<?php

require_once('lemmino.php');
require_once('connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "INSERT INTO Accounts (HeroID, Username, Password, RecoveryEmail) VALUES
    (:id, :username, :password, :email";

    $params = array('id' => $_SESSION['HeroID'],
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email']);

    $prep = $pdo->prepare($query);
    foreach ($params as $k => $v) {
        $prep->bindParam($k, $v);
    }
    $prep->execute();

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
</head>

<body>
    <h1>Be sure to create an account! This way you have access to the Hero Association interface</h1>
    <form action="signup.php" method="POST">
        
        <label for="username">Username:</label>
        <input type="text" name="username">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <label for="email">Email:</label>
        <input type="email" name="email">

        <input type="submit" value="Create Account">

    </form>
</body>

</html>