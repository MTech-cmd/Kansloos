<?php

require_once('lemmino.php');

$duelid = $_GET['d']; 

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Opponent</title>
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/font.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function checkPlayersChoice() {
                $.ajax({
                    url: "check_players_choice.php?d=<?php echo $duelID; ?>",
                    type: "GET",
                    success: function(response) {
                        if (response == "both_selected") {
                            window.location.href = "elo.php";
                        }
                    }
                });
            }

            // Check every 3 seconds
            setInterval(checkPlayersChoice, 3000);
        });
    </script>
</head>

<body>
    <section class="cyberpunk">
        <h1 class="cyberpunk">Waiting for Opponent</h1>
        <p>Please wait for your opponent to make a choice...</p>
        <p><a href="game.php?d=<?php echo $duelID; ?>" class="cyberpunk purple">Refresh</a></p>
    </section>
</body>

</html>
