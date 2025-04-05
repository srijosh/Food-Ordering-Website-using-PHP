<?php

include('../config/constants.php');
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}

header('location:' . SITEURL . 'admin/login.php');

exit();
