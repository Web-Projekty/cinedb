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

    <title>CineDB - Hodnocení</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/rating.css">
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
                    <li><a href="hodnoceni.php" id="selected">Hodnocení</a></li>
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

        <section class="rating">
            <form method="post">

                <?php if (isset($_POST['review']) && empty($_POST['review'])) {
                    echo "<input type='text' name='review' placeholder='Toto pole je povinné' style='border: 1px solid red;'>";
                } elseif (isset($_POST['review']) && $_POST['review'] != NULL) {
                    $review = $_POST['review'];
                    echo "<input type='text' name='review' placeholder='Recenze stránky...'value='$review' style='border: 1px solid black;'>";
                } else {
                    echo "<input type='text' name='review' placeholder='Recenze stránky...' style='border: 1px solid black;'>";
                } ?>
                <input type="radio" name="star" class="hidden" value="0" checked>
                <label><input type="radio" name="star" class="hidden" value="1">
                    <a class="star_on" onclick="star(1)" id="star_1">★</a> </label>
                <label><input type="radio" name="star" class="hidden" value="2">
                    <a class="star_off" onclick="star(2)" id="star_2">★</a> </label>
                <label><input type="radio" name="star" class="hidden" value="3">
                    <a class="star_off" onclick="star(3)" id="star_3">★</a> </label>
                <label><input type="radio" name="star" class="hidden" value="4">
                    <a class="star_off" onclick="star(4)" id="star_4">★</a> </label>
                <label><input type="radio" name="star" class="hidden" value="5">
                    <a class="star_off" onclick="star(5)" id="star_5">★</a> </label>
                <?php if (isset($_POST['star']) && empty($_POST['star'])) {
                    echo "<a style='color:red;'>Toto pole je povinné</a>";
                }
                ?>
                <button type="submit" name="submit" value="1">odeslat recenzi</button>
            </form>
            <?php
            $filename = "../txt/hodnoceni.txt";
            if (!empty($_POST['review']) && !empty($_POST['star']) && isset($_POST['review']) && isset($_POST['star']) && $_POST['star'] != 0) {
                if (!empty($_POST['submit']) && $_POST['submit'] = 1) {
                    if (file_exists("../txt/hodnoceni.txt")) {
                        $filename = "../txt/hodnoceni.txt";
                        $file = fopen($filename, "a");

                        if (filesize($filename) == 0) { //je potřeba odřádkovat??
                            $write = $_POST['review'] . "|" . $_POST['star'];
                        } else {
                            $write = "\n" . $_POST['review'] . "|" . $_POST['star'];
                        }
                        fwrite($file, $write);
                        echo "vaše hodnocení bylo úspěšně zaznamenáno";
                    } else {
                        echo "<p><a style='font-weight: bold;'>File error: </a>204</p>";
                    }
                }
                fclose($file);
            }

            //výpis hodnocení
            if (filesize($filename) != 0) {
                $sum = 0;
                $counter = 0;
                $file = fopen($filename, "r");
                echo "<table>
    <tr>
        <th>Recenze</th>
        <th>
            Hodnocení
        </th>
    </tr>";
                while (!feof($file)) {
                    $line = fgets($file);
                    $values = explode("|", $line);
                    echo "
        <tr>
            <td>$values[0]</td>
            <td>";
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $values[1]) {
                            echo "<a class='star_on'>★</a>";
                        } else {
                            echo "<a class='star_off'>★</a>";
                        }
                    }
                    //průměr hodnocení
                    $sum += $values[1];
                    $counter += 1;
                    echo "</td>
              </tr>";
                }
                echo "<tr>
    <th>Průměrné hodnocení</th>
      <td>";
                echo round($sum / $counter, 2);
                echo "</td>
</tr>
</table>";
            }
            ?>
        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>