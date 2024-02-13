<?php

require_once('lemmino.php');
require_once('connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT * FROM Accounts WHERE Username = :username AND Password = :password";
    $prep = $pdo->prepare($query);
    $prep->bindParam('username', $_POST['username']);
    $prep->bindParam('password', $_POST['password']);
    $prep->execute();
    $res = $prep->fetch();
    
    if ($res) {
        session_start();
        $_SESSION['AdminID'] = $res['AdminID'] ?? '';
        $_SESSION['HeroID'] = $res['HeroID'] ?? '';
    } else {
        $fail = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Log in</title>
</head>

<body>
    <form action="login.php" method="POST">

        <label for="username">Username:</label>
        <input type="text" name="username">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <input type="submit" value="Log in">
    </form>

    <?php if ($fail) { ?>
        <div>Incorrect username or password</div>
    <?php } ?>
</body>

</html>

<?php

require_once('deconnector.php');

?>
