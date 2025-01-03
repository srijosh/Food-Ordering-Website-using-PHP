<?php
include('config/constants.php'); // Database connection
include('user-login-check.php');

if (isset($_POST['submit_payment'])) {
    $payment_method = $_POST['payment_method'];
    date_default_timezone_set('Asia/Kathmandu');
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";
    $username = $_SESSION['user'];

    $sql_user = "SELECT * FROM tbl_user WHERE username='$username'";
    $res_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($res_user);

    $customer_name = $row_user['full_name'];
    $customer_contact = $row_user['contact'];
    $customer_email = $row_user['email'];
    $customer_address = $row_user['address'];

    foreach ($_SESSION['cart'] as $item) {
        $food = $item['title'];
        $new_price = $item['new_price'];
        $qty = $item['quantity'];
        $total_item = $new_price * $qty;

        $sql2 = "INSERT INTO tbl_order SET 
            food = '$food',
            price = $new_price,
            qty = $qty,
            total = $total_item,
            order_date = '$order_date',
            status = '$status',
            payment_status = 'Cash on Delivery',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
        ";

        $res2 = mysqli_query($conn, $sql2);

        // Check whether query executed successfully or not
        if ($res2 == true) {
            // Query Executed and Order Saved
            $_SESSION['order'] = "Food Ordered Successfully!";
        } else {
            // Failed to Save Order
            $_SESSION['order'] = "Failed to Order Food.";
        }
    }

    unset($_POST['submit_payment']);
    unset($_SESSION['cart']);
    unset($_SESSION['total_price']);
    echo "<script>alert('Order has been placed successfully!')</script>";
    header('location:' . SITEURL);
    exit();
}
