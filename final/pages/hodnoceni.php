<!DOCTYPE html>
<html lang="cs">

<head>
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 2;?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databáze seriálů - Hodnocení</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/rating.css">
    <script src="../javascript/rating.js"></script>
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="../../logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav class="header-nav">
                <li><a href="../index.php">Úvod</a></li>
                <li><a href="serialy.php">Seriály</a></li>
                <li><a href="autori.php">Autoři</a></li>
                <li><a href="statistiky.php">Statistiky</a></li>
                <li><a href="hodnoceni.php" id="selected">Hodnocení</a></li>
            </nav>

            <div class="header-login">
                <li><?php
                    include "../account/user_status.php";
                    ?></li>
            </div>
        </header>

        <section class="rating">
            <form method="post">

                <?php if (isset($_POST['review']) && empty($_POST['review'])) {
                    echo "<input type='text' name='review' placeholder='Toto pole je povinné' style='border: 1px solid red;'>";
                } else {
                    echo "<input type='text' name='review' placeholder='Recenze stánky...' style='border: 1px solid black;'>";
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
                <button type="submit">odeslat recenzi</button>
            </form>
            <?php
            if (!empty($_POST['review']) && !empty($_POST['star']) && isset($_POST['review']) && isset($_POST['star']) && $_POST['star'] != 0) {
                if (file_exists("hodnoceni.txt")) {
                    $filename = "hodnoceni.txt";
                    $file = fopen($filename, "a");

                    if (filesize($filename) == 0) { //je potřeba odřádkovat??
                        $write = $_POST['review'] . "|" . $_POST['star'];
                    } else {
                        $write = "\n" . $_POST['review'] . "|" . $_POST['star'];
                    }
                    fwrite($file, $write);
                } else {
                    echo "<a style='font-weight: bold;'>File error: </a>soubor hodnoceni.txt nenalezen";
                }
            }
            ?>

        </section>

        <footer>
            <div class="footer-text">
                <p>2. ročníková práce</p>
                <p>Vytvořil Ondřej Pták, Adam Vlček, Jan Rehák</p>
                <p>12. 4. 2023<!-- Zde bude PHP (datum) --></p>
            </div>
        </footer>
    </div>
</body>

</html>