<?php include "session_start.php" ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User edit</title>
</head>

<body>
    <h2>User edit</h2>
    <form method="get">
        <input type="text" name="new_username" placeholder="enter new username">
        <br>
        <input type="password" name="old_password" placeholder="enter your old password">
        <input type="password" name="new_password1" placeholder="enter your new password">
        <input type="password" name="new_password2" placeholder="verify your new password">
        <button type="submit">change</button>
    </form>
    <a href="session_test.php"><button>session test</button></a>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "accounts";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['new_username']) && !empty($_GET['new_username'])) {


        $new_user = $_GET['new_username'];
        $old_user = $_SESSION['username'];

        $sql = "UPDATE users SET username = '$new_user' WHERE username = '$old_user'";
        $result = $conn->query($sql);
        $_SESSION['username'] = $new_user;
        echo "your username is now :" . $new_user;
    }
    if (isset($_GET['new_password1']) && !empty($_GET['new_password1']) && isset($_GET['new_password2']) && !empty($_GET['new_password2']) && isset($_GET['old_password']) && !empty($_GET['old_password'])) {
        if ($_GET['new_password1'] == $_GET['new_password2']) {
            $user = $_SESSION['username'];
            $sql = "SELECT password FROM users WHERE username = '$user'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if (!empty($row) && $row['password'] == hash("gost-crypto", $_GET['old_password'])) {
                $new_pass = hash("gost-crypto", $_GET['new_password1']);
                $sql = "UPDATE users SET password = '$new_pass' WHERE username = '$user'";
                $result = $conn->query($sql);
                echo "<br>succesfuly changed your password";
            }
        } else {
            echo "<br>zadaná hesla se neschodují";
        }
    } else {
        echo "<br>alespoň jedno pole není zadané";
    }
    ?>
</body>

</html>