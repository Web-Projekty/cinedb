<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php";
include "verification.php"; ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin menu</title>
</head>

<body>
    <h2>Admin super menu</h2>
    <section>
        <a href="author_add.php"> <button>přidat seriály</button></a>
        <a href="show_add.php"> <button>přidat autory</button></a>
    </section>
</body>

</html>