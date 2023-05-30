<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php";
include "verification.php"; ?>
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
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="databáze seriálů, hodnocení seriálů">
    <meta name="description" conntent="Databáze dostupných seriálů a filmů. Podle hodnocení se můžete zvážit zda seriál či film stojí za váš čas a pozornost.">

    <title>Přidání/úprava autorů</title>

    <link rel="shortcut icon" href="../img/logo/logo_icon_exp.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/uvod.css">
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="../img/logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav>
                <ul class="header-nav">
                    <li><a href="../index.php" id="selected">Úvod</a></li>
                    <li><a href="../pages/serialy.php">Seriály</a></li>
                    <li><a href="../pages/autori.php">Autoři</a></li>
                    <li><a href="../pages/statistiky.php">Statistiky</a></li>
                    <li><a href="../pages/hodnoceni.php">Hodnocení</a></li>
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

        <section class="about-website">
            <h2>Přidání/úprava autorů</h2>
            <?php
            if (empty($_GET['submit']) | !isset($_GET['submit'])) {
                echo "<form method='get'>
    <button type='submit' name='submit' value='1'>Úprava autorů</button>
    <button type='submit' name='submit' value='2'>Přidat autory</button>
    <button type='submit' name='submit' value='3'>Upravit databázi</button>
</form>
<a href='index.php'><button>Zpět</button></a>";
                if (!empty($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            } else {
                switch ($_GET['submit']) {
                    case 1:
                        include "../db/active_db.php";
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT idA, jmeno, prijmeni FROM autori";
                        $result = $conn->query($sql);
                        //echo $conn->info;
                        echo "
            <form method='get'>
            <label>Vyber akutualitu pro úpravu
                <select name='idA'>";
                        while ($row = $result->fetch_assoc()) {
                            $idA = $row['idA'];
                            $jmeno = $row['jmeno'];
                            $prijmeni = $row['prijmeni'];
                            echo "<option value='$idA'>$idA | $jmeno $prijmeni</option>";
                        }
                        echo "</select>
            </label>
            <button type='submit' name='submit' value='11'>upravit</button>
            </form>
            <a href='author_add.php'><button>Zpět</button></a>";
                        break;
                    case 11:
                        $idA = $_GET['idA'];
                        $_SESSION['idA'] = $_GET['idA'];
                        $sql = "SELECT idA, jmeno, prijmeni FROM autori WHERE idA = $idA";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result);
                        $jmeno = $row['jmeno'];
                        $prijmeni = $row['prijmeni'];
                        $_SESSION['idAdd'] = $row['idA'];
                        echo "<form method='get'>
            Jméno autora
                <input type='text' name='jmeno' value='$jmeno'>

            Příjmení autora
                <input type='text' name='prijmeni' value='$prijmeni'>

            <button type='submit' name='submit' value='12'>Odeslat úpravy</button>
        </form>
        <a href='author_add.php?submit=1'><button>Zpět</button></a>";
                        break;
                    case 12:
                        $jmeno = $_GET['jmeno'];
                        $prijmeni = $_GET['prijmeni'];
                        $idA = $_SESSION['idA'];
                        $sql = "UPDATE autori SET jmeno = '$jmeno', prijmeni='$prijmeni' WHERE idA = $idA";
                        $result = $conn->query($sql);
                        echo "změna proběhla úspěšně
                        <a href='author_add.php?idA=$idA&submit=11'><button>Zpět</button></a>";
                        break;
                    case 2:
                        echo "<form method='get'>
                        Jméno autora
                            <input type='text' name='jmeno'>
            
                        Příjmení autora
                            <input type='text' name='prijmeni'>
            
                        <button type='submit' name='submit' value='21'>Odeslat úpravy</button>
                    </form>
                    <a href='author_add.php'><button>Zpět</button></a>";
                        break;
                    case 21:
                        $jmeno = $_GET['jmeno'];
                        $prijmeni = $_GET['prijmeni'];
                        $sql = "INSERT INTO autori(jmeno,prijmeni) VALUES( '$jmeno','$prijmeni')";
                        $result = $conn->query($sql);
                        $_SESSION['msg'] = "Autor úspěšně přidán";
                        header("Location: author_add.php");
                        break;
                    case 3:
                        if (empty($_POST['akce']) || empty($_POST['vyber'])) {

                            echo "<form method='post'>";
                            $sql = "SELECT idA, jmeno, prijmeni FROM autori";
                            $result = $conn->query($sql);
                            echo "<table>
            <tr>
                <th>Výběr</th>
                <th>Název</th>
                <th>Datum</th>
            </tr>";
                            while ($row = $result->fetch_assoc()) {
                                $idA = $row['idA'];
                                $jmeno = $row['jmeno'];
                                $prijmeni = $row['prijmeni'];
                                echo " <tr> 
                    <td>
                        <input type='radio' name='vyber' value='$idA'>
                    </td>
                    <td>
                        $jmeno
                    </td>
                    <td>
                        $prijmeni
                    </td>
                    </tr>
                    ";
                            }
                            echo "</table>";
                            echo "
            <select name='akce'>
                <option value='1'>Smazat</option>
            </select>
            <button type='submit'>Provést</button>
        </form>";
                        } else {
                            switch ($_POST['akce']) {
                                case 1:
                                    $idA = $_POST['vyber'];
                                    $sql = "DELETE FROM autori WHERE idA = $idA;";
                                    $result = $conn->query($sql);
                                    $_SESSION['msg'] = "Autor úspěšně smazán";
                                    header("Location: author_add.php");
                                    break;
                                default:
                                    echo "error - default";
                                    break;
                            }
                        }
                        break;
                    default:
                        echo "default";
                        break;
                }
            }

            ?>
        </section>

        <?php include "../include/footer.php" ?>
    </div>

</body>

</html>