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
    $query = "INSERT INTO Backstory (HeroID, OriginStory, Motivation) VALUES
    (:id, :story, :motivation)";


    $params = array(
        ':id' => $_SESSION['HeroID'],
        ':story' => $_POST['story'],
        'motivation' => $_POST['motivation']
    );
    var_dump($_SESSION['HeroID']);
    sendToDB($query, $params, $pdo);

    $query = "INSERT INTO Powers (HeroID, PrimaryPower, Info) VALUES
    (:id, :power, :info)";

    $params = array(
        ':id' => $_SESSION['HeroID'],
        ':power' => $_POST['power'],
        ':info' => $_POST['info']
    );

    sendToDB($query, $params, $pdo);

    header("Location: signup.php");
    die();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Register</title>
    <link rel="stylesheet" href="styling/form.css">
    <link rel="stylesheet" href="styling/backstory.css">
</head>

<body>

    <header style="background-color: #000; height: 50px;">

    </header>

    <section class="cyberpunk">
        <h1 class="cyberpunk glitched">Tell us about yourself</h1>
    </section>

    <section class="cyberpunk black">
        <form action="backstory.php" method="POST">

            <label class="cyberpunk" for="story">Your Origin Story:</label>
            <textarea class="cyberpunk" name="story" maxlength="300"></textarea>

            <label class="cyberpunk" for="motivation">Why do you want to be a hero?</label>
            <textarea class="cyberpunk" name="motivation" maxlength="150"></textarea>

            <label class="cyberpunk" for="power">Your Primary Power:</label>
            <input class="cyberpunk" type="text" name="power" maxlength="50">



            <label class="cyberpunk" for="info">Any additional information about your powers:</label>
            <textarea class="cyberpunk" name="info" maxlength="500"></textarea>

            <input class="cyberpunk green" type="submit" value="Register">

        </form>
    </section>

    <footer style="background-color: #000; height: 50px;"></footer>

</body>

</html>