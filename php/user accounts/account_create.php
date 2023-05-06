<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account create</title>
</head>

<body>
    <h2>Account create</h2>
    <form method="get">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <button type="submit">sign up</button>
    </form>
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

        $sql = "INSERT INTO users (uid, username, password)
VALUES ('NULL', '$user', '$pass')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "alespoň jedno pole není zadané";
    }
    ?>
</body>

</html>