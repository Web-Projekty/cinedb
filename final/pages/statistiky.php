<!DOCTYPE html>
<html lang="cs">

<head>
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 2;
    include "../account/timed_log_out.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CineDB - Statistiky</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/statistiky.css">

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
            <form action="" method="POST">
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
                    if(isset($_POST['vypis'])){
                    //počet seriálů
                    $sql = "SELECT COUNT(idS) as 'tv' from serialy WHERE type = 'tv'";
                    $result = $conn->query($sql);
                    $tv_show_assoc = mysqli_fetch_assoc($result);
                    $tv = $tv_show_assoc['tv'];
                    //počet filmů
                    $sql = "SELECT COUNT(idS) as 'movies' from serialy WHERE type = 'movie'";
                    $result = $conn->query($sql);
                    $movies_assoc = mysqli_fetch_assoc($result);
                    $movies = $movies_assoc['movies'];
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
                    <td>Autoři</td>
                    <td>Uživatelé</td>
                    </tr>
                    <tr>
                    <td>$tv</td>
                    <td>$movies</td>
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