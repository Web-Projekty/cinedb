<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detaily</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/detaily.css">
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

        <section class="details">
            <?php
                //Nelze otevřít v případě, že je otevřený přímo
                include "../db/active_db.php";

                $idS = $_GET['idS'];
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT serialy.idS, serialy.nazev, serialy.idA, autori.jmeno, autori.prijmeni, type from serialy inner join autori on serialy.idA = autori.idA WHERE idS = $idS";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();?>
                    <h2>Detaily k seriálu <?php echo $row['nazev']; ?></h2>
                    <table>
                        <tr>
                            <th>Obrázek</th>
                            <th>ID</th>
                            <th>Název</th>
                            <th>ID Autora</th>
                            <th>Jméno autora</th>
                            <th>Příjmení autora</th>
                            <th>Hodnocení</th>
                            <th>Typ</th>
                            <th>Zpět</th>
                        </tr>
                <?php
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

                    if ($result->num_rows > 0) {
                        echo "<tr>
                        <td><img src='../img/db/$idS.jpg'></td>" .
                            "<td>" . $row['idS'] . "</td>
                        <td>" . $row['nazev'] . "</td>
                        <td>" . $row['idA'] . "</td>
                        <td>" . $row['jmeno'] . "</td>
                        <td>" . $row['prijmeni'] . "</td>
                        <td>" . $ratingAVG . "</td>
                        <td>" . $row['type'] . "</td>
                        <td><a href='serialy.php'>zpět</a>
                        </tr>";
                    }
                    $conn->close();
                    }
                ?>

            <form action="" method="POST">
                <textarea name="recenze" id="recenze" cols="50" rows="5"></textarea>
                <input type="submit" value="odeslat recenzi" name="odeslat">
            </form>
        </section>
        
        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>