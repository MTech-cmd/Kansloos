<?php

require_once('lemmino.php');
require_once('connector.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "INSERT INTO Backstory (HeroID, OriginStory, Motivation) VALUES
    (:id, :story, :motivation)";

    $params = array('id' => $_SESSION['HeroID'],
                    'story' => $_POST['story'],
                    'motivation' => $_POST['motivation']);
    
    $prep = $pdo->prepare($query);
    foreach ($params as $k => $v) {
        $prep->bindParam($k, $v);
    }
    $prep->execute();

    $query = "INSERT INTO Powers (HeroID, PrimaryPower, Info) VALUES
    (:id, :power, :info)";

    $params = array('id' => $_SESSION['HeroID'],
                    'story' => $_POST['story'],
                    'motivation' => $_POST['motivation']);
    
    $prep = $pdo->prepare($query);
    foreach ($params as $k => $v) {
        $prep->bindParam($k, $v);
    }
    $prep->execute();

    header("Location: signup.php");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Regiser</title>
</head>

<body>
    <h1>Tell us about yourself</h1>
    <form action="backstory.php" method="POST">

        <label for="story">Your Origin Story:</label>
        <textarea name="story" maxlength="300"></textarea>

        <label for="motivation">Why do you want to be a hero?</label>
        <textarea name="motivation" maxlength="150"></textarea>

        <label for="power">Your Primary Power:</label>
        <input type="text" name="power" maxlength="50">

        <label for="info">Any additional information about your powers:</label>
        <textarea name="info" maxlength="500"></textarea>

        <input type="submit" value="Register">

    </form>
</body>

</html>