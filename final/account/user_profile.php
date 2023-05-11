<!DOCTYPE html>
<html lang="cs">

<head>
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 3; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databáze seriálů - Autoři</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="../img/logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav class="header-nav">
                <li><a href="../index.php">Úvod</a></li>
                <li><a href="../pages/serialy.php">Seriály</a></li>
                <li><a href="../pages/autori.php">Autoři</a></li>
                <li><a href="../pages/statistiky.php">Statistiky</a></li>
                <li><a href="../pages/hodnoceni.php">Hodnocení</a></li>
            </nav>

            <div class="header-login">
                <li>
                    <?php
                    include "../account/user_status.php";
                    ?>
                </li>
            </div>
        </header>

        <section class="user-profile">
            <?php

            if ($_SESSION['user'] == true) {
                $profileId = $_SESSION['profileId'];
                $user = $_SESSION['username'];
                if (file_exists("../img/profile/$profileId.png")) {
                    echo "<img src='../img/profile/$profileId.png' alt='profile picture' id='profile-pic'>";
                } else {
                    echo "<img src='../img/profile/default.png' alt='profile picture' id='profile-pic'>";
                }
                echo "$user";
            } else {
                echo "prosím přihlašte se";
            }
            ?>

        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>