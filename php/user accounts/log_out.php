<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['user'] = false;
}
?>
<!DOCTYPE html>
<html lang="cs">
<script>
    onload(setTimeout(redirect, 2000))
    /*onload(setInterval(countdown(), 1000))

   */
    function redirect() {
        window.location.href = "session_test.php"
    }
    /*
        var i = 5

        function countdown() {
            var i = 16
            document.getElementById("timer").innerHTML = i

        }*/
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>

<body><?php
        if (!empty($_GET['log_out']) && $_GET['log_out'] == true) {
            session_unset();
            echo "succesfuly logged out, redirecting in 2s...";
        }
        ?>
    <!-- loging out in: <p id="timer">5</p> !-->
</body>

</html>