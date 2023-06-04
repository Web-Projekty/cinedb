<?php include "session_start.php"; ?>
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
    <title>CineDB - Registrace</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">
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
                    <li id="selected">Registrování...</li>
                </ul>
            </div>
        </header>

        <section class="register">

            <h2>Registrace</h2>
            <form method="post">
                <div class="un">
                    <label for="usern">Uživatelské jméno</label>
                    <input type="text" id="usern" name="username" placeholder="Zadejte jméno">
                </div>

                <div class="pw">
                    <label for="passw">Heslo</label>
                    <input type="password" id="usern" name="password" placeholder="Zadejte heslo">
                </div>

                <button type="submit">Registrovat</button>
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

                $sql = "SELECT CASE WHEN EXISTS (SELECT 1 FROM users WHERE username = '$user') THEN 1 ELSE 0 END AS user_exists;";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                if ($row['user_exists'] == 0) {
                    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Registrace proběhla úspěšně!<br>";
                        $_SESSION['login_msg'] = "Registrace proběhla úspěšně! Prosíme přihlašte se.";
                        header("Location: log_in.php");
                    } else {
                        echo "Chyba: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                } else {
                    echo "Účet s zadaným uživatelským jménem již existuje.";
                }
            } else {
                echo "Musíte vyplnit registrační pole!";
            }
            ?>
            <div class="login">
                <p>Už máte účet?</p>
                <a href="log_in.php"><button>Přihlásit se</button></a>
            </div>
        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>