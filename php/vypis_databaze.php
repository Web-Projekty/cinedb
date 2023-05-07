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
    <title>Vypis databáze</title>
</head>

<body>
    <h2>Výpis databáze</h2>
    <table>
        <tr>
            <th>Obrázek</th>
            <th>id</th>
            <th>Název</th>
            <th>id Autora</th>
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
        $sql = "SELECT idS, nazev, idA from serialy";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idS = $row['idS'];

                echo "<tr>
            <td><img src='img/$idS.jpg'></td>" .
                    "<td>" . $row['idS'] . "</td>
            <td>" . $row['nazev'] . "</td>
            <td>" . $row['idA'] . "</td>
            <td><a href='detaily.php?idS=$idS'>odkaz</a>
            </tr>";
            }
            $conn->close();
        }
        ?>
    </table>
</body>

</html>