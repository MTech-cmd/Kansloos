<?php

require_once('lemmino.php');
require_once('connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "INSERT INTO Profile (FirstName, LastName, Alias, BirthDate, StartDate, PrimaryEmail, PhoneNumber, EmergencyContact) VALUES
    (:firstname, :lastname, :alias, :birthdate, :startdate, :email, :phone, :contact)";

    $today = date_create()->format('Y-m-d');

    $params = array('firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'alias' => $_POST['alias'],
                    'birthdate' => $_POST['birthdate'],
                    'startdate' => $today,
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'contact' => $_POST['contact']);

    $prep = $pdo->prepare($query);
    foreach ($params as $k => $v) {
        $prep->bindParam($k, $v);
    }
    $prep->execute();

    session_start();
    $_SESSION['HeroID'] = $pdo->lastInsertId();
    header("Location: backstory.php");
    die();
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
    <form action="register.php" method="POST">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" maxlength="50">

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" maxlength="50">

        <label for="alias">Alias:</label>
        <input type="text" name="alias" maxlength="50">

        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" maxlength="50">

        <label for="email">Email:</label>
        <input type="email" name="email" maxlength="50">

        <label for="phone">Phone number:</label>
        <input type="tel" name="phone" maxlength="30">

        <label for="contact">Emergency Contact:</label>
        <input type="text" name="contact" maxlength="50">

        <input type="submit" value="Next">

    </form>
</body>

</html>

<?php

require_once('deconnector.php');

?>
