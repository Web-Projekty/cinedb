<!DOCTYPE html>
<html lang="cs">

<head>
    <?php include "../account/session_start.php";
    $_SESSION['page'] = 3;
    include "../account/timed_log_out.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databáze seriálů - Autoři</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <header>
            <div class="header-title">
                <img src="../img/logo/logo_exp_wStroke.png" alt="logo">
            </div>

            <nav class="header-nav">
                <li><a href="../index.php">Úvod</a></li>
                <li><a href="../pages/serialy.php">Seriály</a></li>
                <li><a href="../pages/autori.php">Autoři</a></li>
                <li><a href="../pages/statistiky.php">Statistiky</a></li>
                <li><a href="../pages/hodnoceni.php">Hodnocení</a></li>
            </nav>

            <div class="header-login">
                <li>
                    <?php
                    include "../account/user_status.php";
                    ?>
                </li>
            </div>
        </header>

        <section class="user-profile">

            <?php
            if ($_SESSION['user'] == true) {
                $profileId = $_SESSION['profileId'];
                $user = $_SESSION['username'];
                if (file_exists("../img/profile/$profileId.png")) {
                    echo "<img src='../img/profile/$profileId.png' alt='profile picture' id='profile-pic'>";
                } else {
                    echo "<img src='../img/profile/default.png' alt='profile picture' id='profile-pic'>";
                }
                echo "$user";
                if ($_SESSION['user'] == true) {
                    include "../db/active_db.php";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $uid = $_SESSION['uid'];
                    $sql = "SELECT admin FROM users WHERE uid = $uid";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    if ($row['admin'] == 1) {
                        echo "<a href='../admin'><button>admin panel</button></a>";
                    }
                }
                echo "<br><form class='picture-upload' method='post' enctype='multipart/form-data'>
                <input type='file' name='file_upload'>
                <button type='submit' name='submit' value='true'>upload</button>
            </form>";
                if (!empty($_POST['submit'])) {
                    include "../db/active_db.php";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT MAX(profileId) as 'maxprofile' FROM users";

                    $result = $conn->query($sql);
                    //echo $conn->info;
                    $row = $result->fetch_assoc();
                    $profileId = $row['maxprofile'] + 1;
                    $user = $_SESSION['username'];
                    $sql = "UPDATE users SET profileId = '$profileId' WHERE username = '$user'";
                    $result = $conn->query($sql);
                    $_SESSION['profileId'] = $profileId;

                    $uploadOk = 1;
                    $filename = $profileId . ".png";
                    $target_dir = "../img/profile/";
                    $target_file = $target_dir . $filename; //basename($_FILES["file_upload"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    //var_dump($imageFileType);
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
                        if ($check !== false) {
                            //echo "<br>File is an image - " . $check["mime"] . ".<br>";
                            $uploadOk = 1;
                        } else {
                            echo "<br>Typ nahraného souboru nepodporujeme";
                            $uploadOk = 0;
                        }
                    }
                    if ($imageFileType != "png") {
                        echo "<br>Typ nahraného souboru nepodporujeme";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "<br>Omlouváme se, ale váše profilová fotka nebyla změněna";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                            echo "<br>Profilový obrázek úspěšně změněn";
                        } else {
                            echo "<br>Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    echo "<br>Prosím zvolte svůj profilový obrázek";
                }
            } else {
                echo "Prosím přihlašte se";
            }
            ?>

        </section>

        <?php include "../include/footer.php" ?>
    </div>
</body>

</html>