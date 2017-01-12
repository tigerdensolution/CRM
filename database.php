<?php

//database connection.
$host = "localhost";
$username = "root";
$password = "mysql";
$database = "crm";
$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
session_start();

function auto_logout($active) {
    $time = time();
    $active = $_SESSION[$active];
    $diff = $time - $active;
    if ($diff > 3600 || !isset($active)) {
        return true;
    } else {
        $_SESSION['active'] = time();
    }
}
