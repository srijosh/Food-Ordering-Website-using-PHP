<?php
include('config/constants.php');

if (isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $food_id) {
            $item_total = $item['new_price'] * $item['quantity'];
            $_SESSION['total_price'] -= $item_total;
            unset($_SESSION['cart'][$key]);

            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

}

header('location:' . SITEURL . 'mycart.php');
// exit();
