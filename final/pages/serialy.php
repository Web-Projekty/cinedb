<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php"; ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databáze seriálů - Seriály</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/serialy.css">
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
                    <li><a href="serialy.php" id="selected">Seriály</a></li>
                    <li><a href="autori.php">Autoři</a></li>
                    <li><a href="statistiky.php">Statistiky</a></li>
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

        <section class="serials-list">
            <form action="" method="POST">
                <input type="text" name="serialyH">
                <input type="submit" value="vyhledat" name="vyhledat">
            </form>
            <table>
                <tr>
                    <th>Obrázek</th>
                    <th>id</th>
                    <th>Název</th>
                    <th>id Autora</th>
                    <th>hodnocení</th>
                    <th>detaily</th>
                </tr>
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
                $sql = "SELECT serialy.idS, serialy.nazev, serialy.idA from serialy";
                if (isset($_POST['vyhledat'])) {
                    $serialyH = $_POST["serialyH"];
                    $sql = "SELECT serialy.idS, serialy.nazev, serialy.idA from serialy WHERE serialy.nazev LIKE '%$serialyH%'";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $idS = $row['idS'];
                        $sql = "SELECT hodnota from hodnoceni WHERE idS = '$idS'";
                        $rating_result = $conn->query($sql);
                        $counter = 0;
                        $total = 0;
                        while ($rating = $rating_result->fetch_assoc()) {
                            $counter++;
                            $total += $rating['hodnota'];
                        }
                        if ($counter < 1) {
                            $ratingAVG = "žádné recenze";
                        } else {
                            $ratingAVG = $total / $counter;
                        }
                        echo "<tr>
            <td><img src='../img/db/$idS.jpg'></td>" .
                            "<td>" . $row['idS'] . "</td>
            <td>" . $row['nazev'] . "</td>
            <td>" . $row['idA'] . "</td>
            <td>" . $ratingAVG . "</td>
            <td><a href='detaily.php?idS=$idS'>odkaz</a>
            </tr>";
                    }
                    $conn->close();
                }
                ?>
            </table>
        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>