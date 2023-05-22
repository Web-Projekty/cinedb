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
                <h2>O stránce</h2>
                <br>
                <div class="info">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicinelit. Laudantium architecto voluptatum aspernatucupiditate rerum laboriosam, autem dolore haruobcaecati non libero. Blanditiis maiores temporibunatus pariatur ex, omnis corporis modi eum consectetuquia illum tenetur, neque voluptatem ut. Dolores illsit mollitia et nam magni rem doloribus sed maioreut. Voluptates quisquam maxime, quidem tempore placeaenim cupiditate veniam, obcaecati iste veritatimolestiae eum tempora saepe earum necessitatibus iurquae. Excepturi blanditiis aut facere eaque ab maximesint cupiditate corporis fugiat voluptatum magnadeleniti repudiandae ipsa! Doloribus, illum. Temportotam eveniet voluptatum reprehenderit blanditiiducimus? Veniam, fugit pariatur. Maximenecessitatibus.</p>
                    <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt doloribus quae nulla odit, quia ipsam omnis dolore adipisci quo, facere autem atque eaque nisi nam sunt veniam. Maiores ipsam nam, quas nihil rem consectetur blanditiis veritatis provident ducimus reiciendis fugit. Autem modi nemo quibusdam commodi consectetur tempore soluta in? Maiores, maxime! Optio nesciunt a minus fuga quae excepturi doloribus modi alias molestias architecto velit ullam placeat aperiam, voluptatum id hic! Officiis, dolor dignissimos aliquam perferendis voluptates veritatis illum voluptas dicta voluptatum, officia sequi. Est blanditiis nobis aut porro atque accusantium neque aspernatur. Laborum libero laudantium id explicabo aspernatur aliquid odit nobis ipsa et similique optio omnis asperiores itaque porro.</p>
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