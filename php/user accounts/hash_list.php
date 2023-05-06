<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash list</title>
</head>

<body>
    <h2>Hash list</h2>
    <?php
    $algos = hash_algos();
    for ($i = 0; $i < sizeof($algos); $i++) {
        echo $algos[$i]."<br>";
    }
    ?>
</body>

</html>