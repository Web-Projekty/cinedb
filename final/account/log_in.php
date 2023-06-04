<?php include "session_start.php";
$_SESSION['page'] = 5;
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5N5BJHQ74R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5N5BJHQ74R');
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineDB - Přihlášení</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">

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
                    <li id="selected">Přihlašování...</li>
                </ul>
            </div>
        </header>

        <section class="login">

            <h2>Přihlášení</h2>

            <form method="post">
                <div class="un">
                    <label for="usern">Uživatelské jméno</label>
                    <input type="text" id="usern" name="username" placeholder="Zadejte jméno">
                </div>

                <div class="pw">
                    <label for="passw">Heslo</label>
                    <input type="password" id="passw" name="password" placeholder="Zadejte heslo">
                </div>

                <button type="submit">Přihlásit</button>
            </form>

            <?php
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                include "../db/active_db.php";

                $user = $_POST['username'];
                $pass = hash("gost-crypto", $_POST['password']);
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT uid, username, password, profileId FROM users WHERE username = '$user'";
                $result = $conn->query($sql);
                //echo $conn->info;

                $row = $result->fetch_assoc();
                if (!empty($row) && $row['password'] == hash("gost-crypto", $_POST['password'])) {
                    echo "Úspěšně přihlášen!<br>
                    Vítej " . $row['username'];
                    $_SESSION['user'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['profileId'] = $row['profileId'];
                    $_SESSION['time'] = time();
                } else {
                    echo "<a style='color: red;'>Špatně zadané heslo, nebo uživatelské jméno.</a>";
                }
                $conn->close();
            }
            if ($_SESSION['user'] == true) {
                //přesměrování na úvodní stránku
                $url = $_SESSION['url'];
                header("Location: $url");
            }
            if (!empty($_SESSION['login_msg'])) {
                echo $_SESSION['login_msg'];
                unset($_SESSION['login_msg']);
            }
            //výpis hlášky "Ještě nemáte účet? se nezobrazí po registraci nového účtu."
            echo "
            <div class='register'>
                <p>Ještě nemáte účet?</p>
                <a href='create.php'><button>Registrovat se</button></a>
            </div>";
            ?>

        </section>

        <?php include "../include/footer.php" ?>
    </div>

</body>

</html>