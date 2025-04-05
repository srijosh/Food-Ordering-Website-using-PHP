<?php
include('config/constants.php');
include('user-login-check.php');
echo "<script>alert('Order has been placed cancelled!')</script>";
header('location:' . SITEURL);