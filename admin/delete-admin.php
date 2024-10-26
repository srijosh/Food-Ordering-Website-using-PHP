<?php

//Include constants.php file here
include('../config/constants.php');


$id = $_GET['id'];


$sql = "DELETE FROM tbl_admin WHERE id=$id";


$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($res == true) {

    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    //Redirect to Manage Admin Page
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {


    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}
