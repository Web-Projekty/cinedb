<?php
session_start();
if (empty($_SESSION['user'])) {
    $_SESSION['user'] = false;
}
