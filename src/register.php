<?php

require_once('lemmino.php');
require_once('connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
        $maxFileSize = 50 * 1024 * 1024; // 5 MB

        $fileName = $_FILES['picture']['name'];
        $fileSize = $_FILES['picture']['size'];
        $fileType = $_FILES['picture']['type'];
        $fileTmpName = $_FILES['picture']['tmp_name'];

        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Only JPG, PNG, and GIF files are allowed.";
            exit;
        }

        if ($fileSize > $maxFileSize) {
            echo "Error: File size exceeds the limit of 5 MB.";
            exit;
        }

        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . uniqid() . '_' . basename($fileName);

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        chmod($uploadDir, 0777);

        if (move_uploaded_file($fileTmpName, $uploadFile)) {
            $query = "INSERT INTO `Profiles` (`FirstName`, `LastName`, `Alias`, `Picture`, `BirthDate`, `StartDate`, `PrimaryEmail`, `PhoneNumber`, `EmergencyContact`) VALUES
                (:firstname, :lastname, :alias, :picture, :birthdate, :startdate, :email, :phone, :contact)";
            $today = date_create()->format('Y-m-d');
            $params = array(
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'alias' => $_POST['alias'],
                'picture' => $uploadFile,
                'birthdate' => $_POST['birthdate'],
                'startdate' => $today,
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'contact' => $_POST['contact']
            );
            $prep = $pdo->prepare($query);
            foreach ($params as $k => &$v) {
                $prep->bindParam($k, $v);
            }
            $prep->execute();
            session_start();
            $_SESSION['HeroID'] = intval($pdo->lastInsertId());
            header("Location: backstory.php");
            die();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Huel, Mehdi El Khallouki">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/font.css">
</head>

<body>

    <header style="background-color: #000; height: 50px;">
        
    </header>

    <section class="cyberpunk">
        <form action="register.php" method="POST" enctype="multipart/form-data">

            <label class="cyberpunk" for="firstname">First Name:</label>
            <input class="cyberpunk" type="text" name="firstname" maxlength="50">
            <br>
            <br>
            <label class="cyberpunk" for="lastname">Last Name:</label>
            <input class="cyberpunk" type="text" name="lastname" maxlength="50">
            <br>
            <br>
            <label class="cyberpunk" for="alias">Alias:</label>
            <input class="cyberpunk" type="text" name="alias" maxlength="50">
            <br>
            <br>
            <label class="cyberpunk" for="picture">Profile Image:</label>
            <input class="cyberpunk" type="file" name="picture">
            <br>
            <br>
            <label class="cyberpunk" for="birthdate">Birthdate:</label>
            <input class="cyberpunk" type="date" name="birthdate" maxlength="50">
            <br>
            <br>
            <label class="cyberpunk" for="email">Email:</label>
            <input class="cyberpunk" type="email" name="email" maxlength="50">
            <br>
            <br>
            <label class="cyberpunk" for="phone">Phone number:</label>
            <input class="cyberpunk" type="tel" name="phone" maxlength="30">
            <br>
            <br>
            <label class="cyberpunk" for="contact">Emergency Contact:</label>
            <input class="cyberpunk" type="text" name="contact" maxlength="50">
            <br>
            <br>
            <input class="cyberpunk green" type="submit" value="Next">

        </form>
    </section>

    <footer style="background-color: #000; height: 50px;"></footer>
</body>

</html>