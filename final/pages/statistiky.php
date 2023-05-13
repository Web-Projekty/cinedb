<!DOCTYPE html>
<html lang="cs">

<head>
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 2; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databáze seriálů - Statistiky</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table td,
        tr,
        th {
            border: 1px solid black;
        }

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
                <ul>
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
            <table>
                <tr>
                    <td>Seriály</td>
                    <td>Filmy</td>
                    <td>Autoři</td>
                </tr>
                <tr>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "serialy";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT COUNT(idS) as 'tv' from serialy WHERE type = 'tv'";
                    $result = $conn->query($sql);
                    $tv_show_assoc = mysqli_fetch_assoc($result);
                    $tv = $tv_show_assoc['tv'];

                    $sql = "SELECT COUNT(idS) as 'movies' from serialy WHERE type = 'movie'";
                    $result = $conn->query($sql);
                    $movies_assoc = mysqli_fetch_assoc($result);
                    $movies = $movies_assoc['movies'];

                    $sql = "SELECT COUNT(idA) as 'authors' from autori";
                    $result = $conn->query($sql);
                    $authors_assoc = mysqli_fetch_assoc($result);
                    $authors = $authors_assoc['authors'];

                    echo "
                    <td>$tv</td>
                    <td>$movies</td>
                    <td>$authors</td>";
                    ?>
                </tr>
            </table>
        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>