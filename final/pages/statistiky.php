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
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 2;
    include "../account/timed_log_out.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="CineDB, databáze seriálů, hodnocení seriálů, databáze filmů, seriály, filmy, autoři">
    <meta name="description" content="Databáze dostupných seriálů a filmů. Podle hodnocení se můžete zvážit zda seriál či film stojí za váš čas a pozornost.">

    <title>CineDB - Statistiky</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/statistiky.css">
    <link rel="shortcut icon" href="../img/logo/logo_icon_exp.png" type="image/x-icon">
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
                    <li><a href="serialy.php">Seriály</a></li>
                    <li><a href="autori.php">Autoři</a></li>
                    <li><a href="statistiky.php" id="selected">Statistiky</a></li>
                    <li><a href="hodnoceni.php">Hodnocení</a></li>
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

        <section class="statistics">
            <form method="POST">
                <input type="submit" value="výpis tabulky / aktualizace dat" name="vypis">
            </form>
            <?php
            include "../db/active_db.php";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if (isset($_POST['vypis'])) {
                //počet seriálů
                $sql = "SELECT COUNT(idS) as 'tv' from serialy WHERE type = 'TV'";
                $result = $conn->query($sql);
                $tv_show_assoc = mysqli_fetch_assoc($result);
                $tv = $tv_show_assoc['tv'];
                //počet filmů
                $sql = "SELECT COUNT(idS) as 'movies' from serialy WHERE type = 'MOVIE'";
                $result = $conn->query($sql);
                $movies_assoc = mysqli_fetch_assoc($result);
                $movies = $movies_assoc['movies'];
                //počet filmů
                $sql = "SELECT COUNT(idS) as 'ona' from serialy WHERE type = 'ONA'";
                $result = $conn->query($sql);
                $ona_assoc = mysqli_fetch_assoc($result);
                $ona = $ona_assoc['ona'];
                //počet filmů
                $sql = "SELECT COUNT(idS) as 'ova' from serialy WHERE type = 'OVA'";
                $result = $conn->query($sql);
                $ova_assoc = mysqli_fetch_assoc($result);
                $ova = $ova_assoc['ova'];
                //počet filmů
                $sql = "SELECT COUNT(idS) as 'special' from serialy WHERE type = 'Special'";
                $result = $conn->query($sql);
                $special_assoc = mysqli_fetch_assoc($result);
                $special = $special_assoc['special'];
                //počet autorů
                $sql = "SELECT COUNT(idA) as 'authors' from autori";
                $result = $conn->query($sql);
                $authors_assoc = mysqli_fetch_assoc($result);
                $authors = $authors_assoc['authors'];
                //počet uživatelů
                $sql = "SELECT COUNT(uid) as 'users' from users";
                $result = $conn->query($sql);
                $authors_assoc = mysqli_fetch_assoc($result);
                $users = $authors_assoc['users'];
                mysqli_close($conn);
                echo "
                    <table>
                    <tr>
                    <td>Seriály</td>
                    <td>Filmy</td>
                    <td>ONA</td>
                    <td>OVA</td>
                    <td>Special</td>
                    <td>Autoři</td>
                    <td>Uživatelé</td>
                    </tr>
                    <tr>
                    <td>$tv</td>
                    <td>$movies</td>
                    <td>$ona</td>
                    <td>$ova</td>
                    <td>$special</td>
                    <td>$authors</td>
                    <td>$users</td>
                    </tr>
                    </table>";
            }
            ?>
        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>