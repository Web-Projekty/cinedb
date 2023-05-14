<?php include "session_start.php" ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account login</title>
</head>
<h2>Account login</h2>
<form method="get">
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <button type="submit">login</button>
</form>

<body>
    <?php
    if (!empty($_GET['username']) && !empty($_GET['password'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "accounts";

        $user = $_GET['username'];
        $pass = hash("gost-crypto", $_GET['password']);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT uid, username, password, profileId FROM users WHERE username = '$user'";
        $result = $conn->query($sql);
        //echo $conn->info;

        $row = $result->fetch_assoc();
        if (!empty($row) && $row['password'] == hash("gost-crypto", $_GET['password'])) {
            echo "succesfuly logged in<br>
            welcome " . $row['username'];
            $_SESSION['user'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['profileId'] = $row['profileId'];
            $_SESSION['time'] = time();
        }
        $conn->close();
    }

    ?>
    <a href="../index.php"><button>back</button></a>
</body>

</html>