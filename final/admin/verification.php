<?php
if ($_SESSION['user'] == true) {
    include "../db/active_db.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $uid = $_SESSION['uid'];
    $sql = "SELECT admin FROM users WHERE uid = $uid";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['admin'] == 0) {
        echo "<h2>ERROR 403: access denied</h2>";
        die();
    }
} else {
    echo "<h2>ERROR 403: access denied</h2>";
    die();
}
