<?php
include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php";
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detaily</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/detaily.css">
    <script src="../javascript/rating.js"></script>
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
            include "../db/active_db.php";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            if($_GET['idS']){
                $idS = $_GET['idS'];
            }
            $sql = "SELECT serialy.idS, serialy.nazev, autori.jmeno, autori.prijmeni, type from serialy inner join autori on serialy.idA = autori.idA WHERE idS = $idS";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
            <h2><?php echo $row['nazev']; ?></h2>
            <table>
                <tr>
                    <th>Obrázek</th>
                    <th>ID</th>
                    <th>autor</th>
                    <th>hodnocení</th>
                    <th>typ</th>
                    <th>zpět</th>
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
            <td>" . $row['jmeno'] . " " . $row['prijmeni'] . "</td>
            <td>" . $ratingAVG . "</td>
            <td>" . $row['type'] . "</td>
            <td><a href='serialy.php'>zpět</a>
            </tr>";
            }
            }
            ?>

            <form method="post">
            <?php
            if ($_SESSION['user'] == true) {
                if (isset($star)) {
                    $star = $_POST['star'];
                }
                echo "<div class='stars'>
            <input type='radio' name='star' class='hidden' value='0' checked>
            <label><input type='radio' name='star' class='hidden' value='1'>
                <a class='star_on' onclick='star(1)' id='star_1'>★</a> </label>
            <label><input type='radio' name='star' class='hidden' value='2'>
                <a class='star_off' onclick='star(2)' id='star_2'>★</a> </label>
            <label><input type='radio' name='star' class='hidden' value='3'>
                <a class='star_off' onclick='star(3)' id='star_3'>★</a> </label>
            <label><input type='radio' name='star' class='hidden' value='4'>
                <a class='star_off' onclick='star(4)' id='star_4'>★</a> </label>
            <label><input type='radio' name='star' class='hidden' value='5'>
                <a class='star_off' onclick='star(5)' id='star_5'>★</a> </label>
            </div>";
                if (isset($star) && empty($star)) {
                    echo "<a style='color:red;'>Toto pole je povinné!</a>";
                }
                echo "
            <input type='submit' name='submit' value='Odeslat recenzi'>
            </form>";
            }

            if (!empty($_POST['star']) && isset($_POST['star']) && $_POST['star'] != 0 && $_SESSION['user'] == true) {
                if (isset($_POST['submit'])) {
                    //zápis
                    $idS = $_GET["idS"];
                    $uzivatel = $_SESSION['username'];
                    $hodnota = $_POST["star"];
                    $sql = "INSERT INTO hodnoceni (idS, uzivatel, hodnota)
                    VALUES ('$idS', '$uzivatel', '$hodnota')";
                    echo "vaše hodnocení bylo úspěšně zaznamenáno";
                } else {
                    echo "<p><a style='font-weight: bold;'>File error: </a>204</p>";
                }
            } else {
                echo "Prosím přihlaš se než ohodnotíš tento seriál/film.<br>";
            }
            //výpis hodnocení
            echo "<h3>recenze</h3>";
            $sql = "SELECT idH, uzivatel, hodnota from hodnoceni where idS = $idS";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                echo "<table><tr><td>ID</td><td>uživatel</td><td>hodnocení</td></tr>";
                while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["idH"]. "</td><td>" . $row["uzivatel"]. "</td><td>" . $row["hodnota"]. "</td></tr>";
                }
                echo "</table>";
                
              } else {
                echo "0 results";
              }
            
            $conn->close();
            ?>
        </section>
        
        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>