<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['user'] = false;
}
?>
<!DOCTYPE html>
<html lang="cs">
<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table td,
    tr,
    th {
        border: 1px solid black;
    }

    img {
        width: 100px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session test</title>
</head>

<body>
    <h2>Session test</h2>
    <?php
    var_dump($_SESSION);
    ?>
    <a href="account_login.php"><button>login</button></a>
    <form method="get" action="log_out.php">
        <button type="submit" name="log_out" value="true">log out</button>
    </form>

    <?php

    if ($_SESSION['user'] == true) {
        $uid = $_SESSION['uid'];
        echo "<table>
        <tr>
            <th>Profile pic</th>
            <th>uid</th>
            <th>username</th>
        </tr>
        <tr>
            <td><img src='pics/$uid.png'></td>
            <td>" . $uid . "</td>
            <td>" . $_SESSION['username'] . "</td>
        </tr>
    </table>";
    }
    
    ?>
</body>

</html>