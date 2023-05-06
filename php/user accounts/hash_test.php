<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash test</title>
</head>

<body>
    <h2>Hash test</h2>
    <form method="get">
        <input type="text" name="password" placeholder="password">
        <button type="submit">submit</button>
    </form>
    <?php
    if (!empty($_GET['password'])){
        echo hash("sha256",$_GET['password']);
    }
    ?>
</body>

</html>