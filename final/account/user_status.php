<?php

switch ($_SESSION['page']) {
    case 1: // root/index
        if (!$_SESSION['user']) {
            echo "<a href='account/log_in.php'>Přihlásit se</a> / <a href='account/create.php'>Registrovat se</a>";
        } else {
            $username = $_SESSION['username'];
            echo "<a href='account/user_profile.php'>$username</a> / <a href='account/log_out.php'>Odhlásit se</a>";
        }
        break;
    case 2: // root/pages/*
        if (!$_SESSION['user']) {
            echo "<a href='../account/log_in.php'>Přihlásit se</a> / <a href='../account/create.php'>Registrovat se</a>";
        } else {
            $username = $_SESSION['username'];
            echo "<a href='../account/user_profile.php'>$username</a> / <a href='../account/log_out.php'>Odhlásit se</a>";
        }
        break;
    case 3: // root/account/user_profile
        if (!$_SESSION['user']) {
            echo "<a href='../account/log_in.php'>Přihlásit se</a> / <a href='../account/create.php'>Registrovat se</a>";
        } else {
            $username = $_SESSION['username'];
            echo "<a href='../account/user_profile.php' id='selected'>$username</a> / <a href='../account/log_out.php'>Odhlásit se</a>";
        }
        break;
    default:
        echo "<br><b>user status error</b> 101";
}
