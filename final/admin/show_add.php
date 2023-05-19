<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php";
include "verification.php"; ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="databáze seriálů, hodnocení seriálů">
    <meta name="description" conntent="Databáze dostupných seriálů a filmů. Podle hodnocení se můžete zvážit zda seriál či film stojí za váš čas a pozornost.">

    <title>Přidat seriál</title>

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
            <h2>Přidání/úprava seriálu</h2>
            <?php
            if (empty($_GET['submit']) | !isset($_GET['submit'])) {
                echo "<form method='get'>
    <button type='submit' name='submit' value='1'>Úprava serálů</button>
    <button type='submit' name='submit' value='2'>Přidat seriál</button>
    <button type='submit' name='submit' value='3'>Upravit databázi WIP</button>
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

                        $sql = "SELECT idS, nazev, idA, type FROM serialy";
                        $result = $conn->query($sql);
                        //echo $conn->info;
                        echo "
            <form method='get'>
            <label>Vyber seriál pro úpravu
                <select name='idS'>";
                        while ($row = $result->fetch_assoc()) {
                            $nazev = $row['nazev'];
                            $idS = $row['idS'];
                            echo "<option value='$idS'>$idS | $nazev</option>";
                        }
                        echo "</select>
            </label>
            <button type='submit' name='submit' value='11'>upravit</button>
            </form>
            <a href='show_add.php'><button>Zpět</button></a>";
                        break;
                    case 11:
                        $idS = $_GET['idS'];
                        $_SESSION['idS'] = $_GET['idS'];
                        $sql = "SELECT idS, nazev, idA, type FROM serialy WHERE idS = $idS";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result);
                        $nazev = $row['nazev'];
                        $_SESSION['idAdd'] = $row['idA'];
                        echo "<form method='get'>
            Název seriálu
                <input type='text' name='nazev' value='$nazev'>

            Autor
                <select name='autor'>";
                        $sql = "SELECT idA, jmeno, prijmeni FROM autori";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $jmeno = $row['jmeno'];
                            $idA = $row['idA'];
                            $prijmeni = $row['prijmeni'];
                            if ($_SESSION['idAdd'] == $idA) {
                                echo "<option selected value='$idA'>$idA | $jmeno $prijmeni </option>";
                            } else {
                                echo "<option value='$idA'>$idA | $jmeno $prijmeni </option>";
                            }
                        }
                        echo "
                </select>
                Typ
                <select name='type'>";
                        include "../db/typy.php";
                        for ($i = 0; $i < sizeof($typy); $i++) {
                            echo "<option value='$typy[$i]'>" . $typy[$i] . "</option>";
                        }
                        echo "</select>
            <button type='submit' name='submit' value='12'>Odeslat úpravy</button>
        </form>
        <a href='show_add.php?submit=1'><button>Zpět</button></a>";
                        break;
                    case 12:
                        $nazev = $_GET['nazev'];
                        $autor = $_GET['autor'];
                        $type = $_GET['type'];
                        $idS = $_SESSION['idS'];
                        $sql = "UPDATE serialy SET nazev = '$nazev', idA='$autor', type='$type' WHERE idS=$idS";
                        $result = $conn->query($sql);
                        echo "změna proběhla úspěšně
                        <a href='index.php'><button>Zpět</button></a>";
                        break;
                    case 2:
                        $sql = "SELECT idA, jmeno, prijmeni FROM autori";
                        $result = $conn->query($sql);
                        echo "<form method='get'>
            Název seriálu
                <input type='text' name='nazev'>

            Autor
                <select name='autor'>";
                        while ($row = $result->fetch_assoc()) {
                            $jmeno = $row['jmeno'];
                            $idA = $row['idA'];
                            $prijmeni = $row['prijmeni'];
                            echo "<option value='$idA'>$idA | $jmeno $prijmeni </option>";
                        }
                        echo "
                </select>
                Typ
                <select name='type'>";
                        include "../db/typy.php";
                        for ($i = 0; $i < sizeof($typy); $i++) {
                            echo "<option value='$typy[$i]'>" . $typy[$i] . "</option>";
                        }
                        echo "</select>
            <button type='submit' name='submit' value='21'>Odeslat úpravy</button>
        </form>
        <a href='show_add.php'><button>Zpět</button></a>";
                        break;
                    case 21:
                        $nazev = $_GET['nazev'];
                        $autor = $_GET['autor'];
                        $type = $_GET['type'];
                        $sql = "INSERT INTO serialy(nazev,idA,type) VALUES( '$nazev','$autor','$type')";
                        $result = $conn->query($sql);
                        $_SESSION['msg'] = "Seriál úspěšně přidán";
                        header("Location: show_add.php");
                        break;
                    case 3:
                        if (empty($_POST['akce']) || empty($_POST['vyber'])) {

                            echo "<form method='post'>";
                            $sql = "SELECT idS, nazev, idA, type FROM serialy";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $idS = $row['idS'];
                            $nazev = $row['nazev'];
                            $type = $row['type'];
                            $result = $conn->query($sql);
                            echo "<table>
            <tr>
                <th>Výběr</th>
                <th>Id</th>
                <th>Název</th>
            </tr>";
                            while ($row = $result->fetch_assoc()) {
                                $idS = $row['idS'];
                                $nazev = $row['nazev'];
                                $type = $row['type'];
                                echo " <tr> 
                    <td>
                        <input type='radio' name='vyber' value='$idS'>
                    </td>
                    <td>
                        $nazev
                    </td>
                    <td>
                        $type
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
                                    $idS = $_POST['vyber'];
                                    $sql = "DELETE FROM serialy WHERE idS = $idS;";
                                    $result = $conn->query($sql);
                                    $_SESSION['msg'] = "Seriál byl úspěšně smazán.";
                                    header("Location: show_add.php");
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