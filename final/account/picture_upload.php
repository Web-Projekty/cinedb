<?php include "session_start.php" ?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5N5BJHQ74R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5N5BJHQ74R');
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture upload</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file_upload">
        <button type="submit" name="submit" value="true">upload</button>
    </form>
    <a href="session_test.php"><button>session test</button></a>
    <?php
    if ($_SESSION['user'] == true) {
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
            var_dump($imageFileType);
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
                if ($check !== false) {
                    echo "<br>File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "<br>File is not an image.";
                    $uploadOk = 0;
                }
            }
            if ($imageFileType != "png") {
                echo "<br>Sorry, only PNG files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "<br>Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                    echo "<br>The file " . $filename . " has been uploaded.";
                } else {
                    echo "<br>Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "<br>please select a profile picture";
        }
    } else {
        echo "please log in before changing your profile picture";
    }
    ?>
</body>

</html>