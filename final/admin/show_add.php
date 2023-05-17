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
    <title>Přidání seriálu</title>
</head>

<body>
    <h2>Přidání seriálu</h2>
    <?php
    if (empty($_GET['submit']) | !isset($_GET['submit'])) {
        echo "<form method='get'>
    <button type='submit' name='submit' value='1'>Úprava serálů</button>
    <button type='submit' name='submit' value='2'>Přidat seriál WIP</button>
    <button type='submit' name='submit' value='3'>Upravit databázi WIP</button>
</form>";
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
            <label>Vyber akutualitu pro úpravu
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
            ";
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
        </form>";
                break;
            case 12:
                $nazev = $_GET['nazev'];
                $autor = $_GET['autor'];
                $type = $_GET['type'];
                $idS = $_SESSION['idS'];
                $sql = "UPDATE serialy SET nazev = '$nazev', idA='$autor', type='$type' WHERE idS=$idS";
                $result = $conn->query($sql);
                echo "změna proběhla úspěšně";
                break;
            case 2:
                echo "<form method='get' class='thiccc'>
            Náze aktuality
                <input type='text' name='heading'>

            Změna datumu
                <input type='date'name='date'>

            Obsah aktuality
                <textarea name='content' cols='30' rows='15'></textarea>
            <button type='submit' name='submit' value='21'>Odeslat úpravy</button>
        </form>";
                break;
            case 21:
                $content = $_GET['content'];
                $date = $_GET['date'];
                $heading = $_GET['heading'];
                $sql = "INSERT INTO aktuality(date,heading,content) VALUES( '$date 00:00:00','$heading','$content')";
                $result = $conn->query($sql);
                break;
            case 3:
                if (empty($_POST['akce']) || empty($_POST['vyber'])) {

                    echo "<form method='post'>";
                    $sql = "SELECT idA, date, heading, content FROM aktuality";
                    $result = $conn->query($sql);
                    echo "<table>
            <tr>
                <th>Výběr</th>
                <th>Název</th>
                <th>Datum</th>
            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        $heading = $row['heading'];

                        $idA = $row['idA'];
                        //timestamp
                        $date = $row['date'];
                        $tmp1 = explode(" ", $row['date']);
                        //date
                        $tmp2 = explode("-", $tmp1[0]);
                        $date = date("d. m. Y", mktime(0, 0, 0, $tmp2[1], $tmp2[2], $tmp2[0]));
                        echo " <tr> 
                    <td>
                        <input type='radio' name='vyber' value='$idA'>
                    </td>
                    <td>
                        $heading
                    </td>
                    <td>
                        $date
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
                            $sql = "DELETE FROM aktuality WHERE idA = $idA;";
                            $result = $conn->query($sql);
                            echo "Aktualita úspěšně smazána.";
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
</body>

</html>