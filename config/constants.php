<?php
//Start Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection Failed!: " . mysqli_connect_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die("Cannot find or select database!: " . mysqli_connect_error());
}
