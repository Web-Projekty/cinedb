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

    .star_off {
        color: black;
        -webkit-text-stroke: 1px;
        -webkit-text-stroke-color: black;
        -webkit-text-fill-color: white;
    }

    .star_on {
        color: yellow;
        -webkit-text-stroke: 1px;
        -webkit-text-stroke-color: black;
        transition: 200ms;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vypis hodnoceni</title>
</head>

<body>
    <h2>Vypis hodnoceni</h2>
    <?php
    $filename = "hodnoceni.txt";
    $sum = 0;
    $counter = 0;
    //výpis hodnocení
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
    echo $counter . "<br>";
    echo $sum;
    ?>
</body>

</html>