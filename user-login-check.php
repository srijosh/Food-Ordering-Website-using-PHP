<?php

//AUthorization - Access COntrol
//CHeck whether the user is logged in or not
if (!isset($_SESSION['user'])) //IF user session is not set
{
    //User is not logged in
    //REdirect to login page with message
    $_SESSION['no-user-login-message'] = "<div class='error text-center'>Please login.</div>";
    //REdirect to Login Page
    header('location:' . SITEURL . 'login.php');
    exit();
}
