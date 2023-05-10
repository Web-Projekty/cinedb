<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User status</title>
</head>

<body>
    <h2>User status</h2>
    <?php include "session_start.php";
    if ($_SESSION['user']) {
        echo "Welcome " . $_SESSION['username'];
    } else {
        echo "You are not logged in <a href='account_login.php'>login</a>";
    }
    ?>
</body>

</html>