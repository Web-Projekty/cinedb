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
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="databáze seriálů, hodnocení seriálů">
    <meta name="description" conntent="Databáze dostupných seriálů a filmů. Podle hodnocení se můžete zvážit zda seriál či film stojí za váš čas a pozornost.">

    <title>Admin menu</title>

    <link rel="shortcut icon" href="../img/logo/logo_icon_exp.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/uvod.css">
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="../img/logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav>
                <ul class="header-nav">
                    <li><a href="../index.php">Úvod</a></li>
                    <li><a href="../pages/serialy.php">Seriály</a></li>
                    <li><a href="../pages/autori.php">Autoři</a></li>
                    <li><a href="../pages/statistiky.php">Statistiky</a></li>
                    <li><a href="../pages/hodnoceni.php">Hodnocení</a></li>
                </ul>
            </nav>

            <div class="header-login">
                <ul>
                    <li>
                        <?php include "../account/user_status.php"; ?>
                    </li>
                </ul>
            </div>
        </header>

        <section class="about-website">
            <h2>Admin super menu</h2>
            <section>
                <a href="show_add.php"> <button>Seriály</button></a>
                <a href="author_add.php"> <button>Autoři</button></a>
            </section>

        </section>

        <?php include "../include/footer.php" ?>
    </div>

</body>

</html>