<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="databáze seriálů, hodnocení seriálů">

    <title>Databáze seriálů - Hodnocení</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="" alt="logo">
                <h1>Databáze seriálů</h1>
            </div>

            <nav class="header-nav">
                <li><a href="index.php" id="selected">Úvod</a></li>
                <li><a href="pages/serialy.php">Seriály</a></li>
                <li><a href="pages/autori.php">Autoři</a></li>
                <li><a href="pages/statistiky.php">Statistiky</a></li>
                <li><a href="pages/hodnoceni.php">Hodnocení</a></li>
            </nav>
        </header>

        <section>
            <h2>O stránce</h2>
            <p></p>
        </section>

        <footer>
            <p>2. ročníková práce</p>
            <p>Vytvořil Ondřej Pták, Adam Vlček, Jan Rehák</p>
            <p><?php echo date("d/m/Y") ?></p>
        </footer>
    </div>

</body>

</html>