<?php

switch ($_SESSION['page']) {
    case 1:
        if (!$_SESSION['user']) {
            echo "<a href='account/account_login.php'>Přihlásit se</a> / <a href='account/account_create.php'>Registrovat se</a>";
        } else {
            $username = $_SESSION['username'];
            echo "<a href='account/session_test.php'>$username</a> / <a href='account/log_out.php'>Odhlásit se</a>";
        }
        break;
    case 2:
        if (!$_SESSION['user']) {
            echo "<a href='../account/account_login.php'>Přihlásit se</a> / <a href='../account/account_create.php'>Registrovat se</a>";
        } else {
            $username = $_SESSION['username'];
            echo "<a href='../account/session_test.php'>$username</a> / <a href='../account/log_out.php'>Odhlásit se</a>";
        }
        break;
    default:
        echo "<br><b>user status error</b> 101";
}
