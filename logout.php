<?php

if (isset($_GET['data'])) {
    require_once 'database.php';
    session_destroy();
    header("location:login.php");
    $conn = NULL;
} else {
    header("location:inedx.php");
}