<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .hidden {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
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
    <script>
        //barvy hvězd
        function star(star_location) {
            //vybere všechny elementy menší a rovny zakliknuté hvězdě a označí je
            for (var i = 1; i <= star_location; i++) {
                var id_name = "star_" + i
                document.getElementById(id_name).attributes[0].value = "star_on"
            }
            //vybere všechny elementy větší zakliknuté hvězdě a odnačí je
            for (var i = star_location + 1; i <= 5; i++) {
                var id_name = "star_" + i
                document.getElementById(id_name).attributes[0].value = "star_off"
            }
        }
    </script>
    <title>Hodnoceni</title>
</head>

<body>
    <h2>Hodnocení stránky</h2>
    <form method="post">

        <?php if (isset($_POST['review']) && empty($_POST['review'])) {
            echo "<input type='text' name='review' placeholder='Toto pole je povinné' style='border: 1px solid red;'>";
        } else {
            echo "<input type='text' name='review' placeholder='Recenze stánky...' style='border: 1px solid black;'>";
        } ?>
        <input type="radio" name="star" class="hidden" value="0" checked>
        <label><input type="radio" name="star" class="hidden" value="1">
            <a class="star_on" onclick="star(1)" id="star_1">★</a> </label>
        <label><input type="radio" name="star" class="hidden" value="2">
            <a class="star_off" onclick="star(2)" id="star_2">★</a> </label>
        <label><input type="radio" name="star" class="hidden" value="3">
            <a class="star_off" onclick="star(3)" id="star_3">★</a> </label>
        <label><input type="radio" name="star" class="hidden" value="4">
            <a class="star_off" onclick="star(4)" id="star_4">★</a> </label>
        <label><input type="radio" name="star" class="hidden" value="5">
            <a class="star_off" onclick="star(5)" id="star_5">★</a> </label>
        <?php if (isset($_POST['star']) && empty($_POST['star'])) {
            echo "<a style='color:red;'>Toto pole je povinné</a>";
        }
        ?>
        <button type="submit">odeslat recenzi</button>
    </form>
    <?php
    if (!empty($_POST['review']) && !empty($_POST['star']) && isset($_POST['review']) && isset($_POST['star']) && $_POST['star'] != 0) {
        if (file_exists("hodnoceni.txt")) {
            $filename = "hodnoceni.txt";
            $file = fopen($filename, "a");

            if (filesize($filename) == 0) { //je potřeba odřádkovat??
                $write = $_POST['review'] . "|" . $_POST['star'];
            } else {
                $write = "\n" . $_POST['review'] . "|" . $_POST['star'];
            }
            fwrite($file, $write);
        } else {
            echo "<a style='font-weight: bold;'>File error: </a>soubor hodnoceni.txt nenalezen";
        }
    }
    ?>
</body>

</html>