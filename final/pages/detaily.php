<!DOCTYPE html>
<html lang="cs">
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detaily</title>
</head>
<?php
//Nelze otevřít v případě, že je otevřený přímo
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serialy";
$idS = $_GET['idS'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idS, nazev, idA, type from serialy WHERE idS = $idS";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); ?>
    <h2>Detaily k seriálu <?php echo $row['nazev']; ?></h2>
    <table>
        <tr>
            <th>Obrázek</th>
            <th>id</th>
            <th>Název</th>
            <th>id Autora</th>
            <th>hodnocení</th>
            <th>typ</th>
            <th>zpět</th>
        </tr>

        <body>
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
            <td>" . $ratingAVG . "</td>
            <td>" . $row['type'] . "</td>
            <td><a href='serialy.php'>odkaz</a>
            </tr>";
        }
        $conn->close();
    }
        ?>
        </body>

</html>