<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['user'] = false;
}
?>
<!DOCTYPE html>
<html lang="cs">

<style>body{
    display: flex;
}
    </style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>

<body id="flex"><?php
        if (!empty($_GET['log_out']) && $_GET['log_out'] == true) {
            session_unset();
            echo "<p>succesfuly logged out, redirecting in: </p>";
        }
        ?>
     <p id="counter" onload="startCount()" style="flex-direction: row;">5</p>
    <script>
        timer = setInterval(count, 1000); // 200 = 200ms delay between counter changes. Lower num = faster, Bigger = slower.

        function count() {
            var rand_no = 1 // 9 = random decrement amount. Counter will decrease anywhere from 1 - 9.
            var el = document.getElementById("counter");
            var currentNumber = parseFloat(el.innerHTML);
            var newNumber = currentNumber - rand_no;
            if (newNumber > 0) {
                el.innerHTML = newNumber;
                console.log(currentNumber)
            } else {
                window.location.replace("session_test.php");
            }
        }
    </script>
</body>

</html>