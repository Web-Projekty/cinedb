<?php 
    include "account/session_start.php";
    $_SESSION['page'] = 1;
    include "account/timed_log_out.php"; 
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pták, Vlček, Rehák">
    <meta name="keywords" content="databáze seriálů, hodnocení seriálů">
    <meta name="description" conntent="Databáze dostupných seriálů a filmů. Podle hodnocení se můžete zvážit zda seriál či film stojí za váš čas a pozornost.">

    <title>CineDB - Databáze seriálů</title>

    <link rel="shortcut icon" href="img/logo/logo_icon_exp.png" type="image/x-icon">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/uvod.css">
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="img/logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav>
                <ul class="header-nav">
                    <li><a href="index.php" id="selected">Úvod</a></li>
                    <li><a href="pages/serialy.php">Seriály</a></li>
                    <li><a href="pages/autori.php">Autoři</a></li>
                    <li><a href="pages/statistiky.php">Statistiky</a></li>
                    <li><a href="pages/hodnoceni.php">Hodnocení</a></li>
                </ul>
            </nav>

            <div class="header-login">
                <ul>
                    <li>
                        <?php include "account/user_status.php"; ?>
                    </li>
                </ul>
            </div>
        </header>

        <div class="flex-box sections">
            <section class="about-website">
                <h2>Vítejte na CineDB!</h2>
                <br>
                <div class="info">
                    <p>Jsme československá stránka pro všechny možné seriály všech žánrů.</p>
                    <p>Pod záložkou seriály najdete všechny seriály, které se momentálně vyskytují u nás v databázi. Pokud vám nějaký chybí, tak ho můžete se vší libostí, po přihlášení, přidat a ohodnotit.</p>
                    <p>V záložce autoři se nachází každý autor, který má své dílo v záložce seriály.</p>
                    <p>Statistiky vypisují aktuální počet seriálů, filmů, autorů a uživatelů. Zkrátka to shrnuje základní statistiky stránky.</p>
                    <p>Na závěr tu máme hodnocení, kde, pokud se vám bude chtít, můžete ohodnotit naši stránku od 1 do 5.</p>
                    <p>Děkujeme za přečtení a přejeme příjemné prohlížení!</p>
                </div>
            </section>

            <section class="about-website">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est vel consequuntur quisquam ex corporis. Ducimus laboriosam cupiditate vel soluta nesciunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita dolorem vitae sunt dolore. Temporibus sint cupiditate dolorum porro saepe beatae quia voluptatem quae, officiis, ipsa tempore unde sit blanditiis praesentium.</p>
            </section>
        </div>

        <?php include "include/footer.php" ?>
    </div>

</body>

</html>