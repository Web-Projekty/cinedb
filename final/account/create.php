<!DOCTYPE html>
<html lang="cs">

<head>
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

            <nav class="header-nav">
                <ul>
                    <li><a href="../index.php" id="selected">Úvod</a></li>
                    <li><a href="../pages/serialy.php">Seriály</a></li>
                    <li><a href="../pages/autori.php">Autoři</a></li>
                    <li><a href="../pages/statistiky.php">Statistiky</a></li>
                    <li><a href="../pages/hodnoceni.php">Hodnocení</a></li>
                </ul>
            </nav>

             <div class="header-login">
                <ul>
                    <li>Registrování...</li>
                </ul>
            </div>
        </header>

        <section class="register">
            
            <h2>Registrace</h2>
            <form method="get">
                <label for="usern">Uživatelské jméno</label>
                <input type="text" name="username" placeholder="Jméno">

                <label for="passw">Heslo</label>
                <input type="password" name="password" placeholder="Heslo">

                <button type="submit">Registrovat</button>
            </form>

            <?php
            if (!empty($_GET['username']) && !empty($_GET['password'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "accounts";

                $user = $_GET['username'];
                $pass = hash("gost-crypto", $_GET['password']);
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO users (uid, username, password) VALUES ('NULL', '$user', '$pass')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registrace proběhla úspěšně!";
                } else {
                    echo "Chyba: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "<p>Musíte vyplnit registrační pole!</p>";
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