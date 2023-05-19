<?php include "../account/session_start.php";
$_SESSION['page'] = 2;
include "../account/timed_log_out.php"; ?>
<!DOCTYPE html>
<html lang="cs">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CineDB - Autoři</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/autori.css">

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
                    <li><a href="autori.php" id="selected">Autoři</a></li>
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

        <section class="authors">
            <form action="" method="POST">
                <?php
                    $autoriH = "";
                    if(isset($_POST["autoriH"])){
                        $autoriH = $_POST["autoriH"];
                    }
                    $radic = "";
                    if(isset($_POST["radic"])){
                        $radic = $_POST["radic"];
                    }
                ?>
                <input type="text" name="autoriH" value="<?php echo $autoriH ?>" placeholder="zadej jméno">
                <input type="submit" value="vyhledat" name="vyhledat">

                <select name="radic">
                    <option value="autori.jmeno ASC" <?php if($radic == "autori.jmeno ASC") echo "selected" ?>>podle jména</option>
                    <option value="autori.prijmeni ASC" <?php if($radic == "autori.prijmeni ASC") echo "selected" ?>>podle přijmení</option>
                    <option value="autori.idA ASC" <?php if($radic == "autori.idA ASC") echo "selected" ?>>podle ID</option>
                </select>
                <input type="submit" value="řadit" name="radit">
            </form>
            
            <table>
                <tr>
                    <th>ID Autora</th>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                </tr>
                <?php
                include "../db/active_db.php";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT autori.idA, autori.jmeno, autori.prijmeni from autori";
                if(isset($_POST['vyhledat'])){
                    $autoriH = $_POST["autoriH"];
                    $sql .= " WHERE autori.jmeno LIKE '%$autoriH%'";
                }
                if(isset($_POST["radit"])){
                    $radic = $_POST["radic"];
                    $autoriH = $_POST["autoriH"];
                    $sql = "SELECT autori.idA, autori.jmeno, autori.prijmeni from autori WHERE autori.jmeno LIKE '%$autoriH%' ORDER BY $radic";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $idA = $row['idA'];
                        echo "<tr>
                        <td>" . $row['idA'] . "</td>
                        <td>" . $row['jmeno'] . "</td>
                        <td>" . $row['prijmeni'] . "</td>
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