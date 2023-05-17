<?php
if ($_SESSION['user'] == true) {
    if (time() - $_SESSION['time'] > 1200 && $_SESSION['page'] != 4) {
        switch ($_SESSION['page']) {
            case 1:
                $_SESSION['msg'] = "Odhlášen z důvodu neaktivity";
                header("Location: account/log_out.php");
                die();
                break;
            case 2:
                $_SESSION['msg'] = "Odhlášen z důvodu neaktivity";
                header("Location: ../account/log_out.php");
                die();
                break;
            case 3:
                $_SESSION['msg'] = "Odhlášen z důvodu neaktivity";
                header("Location: log_out.php");
                die();
                break;
        }
    } else {
        $_SESSION['time'] = time();
    }
}
if (empty($_SESSION['page']) || $_SESSION['page'] != 5) {
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
