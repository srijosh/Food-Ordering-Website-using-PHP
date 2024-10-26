<?php
include('config/constants.php');


if (isset($_POST['food_id']) && isset($_POST['quantity'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];


    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $food_id) {
            $item_total = $item['new_price'] * $item['quantity'];
            $_SESSION['total_price'] -= $item_total;
            $item['quantity'] = $quantity;
            $item_total = $item['new_price'] * $item['quantity'];
            $_SESSION['total_price'] += $item_total;
            break;
        }
    }
}

header('location:' . SITEURL . 'mycart.php');
// exit();
