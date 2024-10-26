<?php
//Include constants.php for SITEURL
include('config/constants.php');
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']); //Unsets $_SESSION['user']
    $_SESSION['logout'] = "Logged Out Sucessfully!";
}

//2. REdirect to Login Page
header('location:' . SITEURL . '');

exit();
