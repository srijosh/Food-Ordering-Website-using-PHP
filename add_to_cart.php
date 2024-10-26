<?php
include('config/constants.php'); // Include the database connection and constants

//check if user is logged in before adding to cart
include('user-login-check.php');

if (isset($_POST['add_to_cart'])) {
    $food_id = $_POST['food_id'];
    $quantity = 1; // default quantity

    // Retrieve food details from the database
    $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $item_array = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'new_price' => $row['new_price'],
            'quantity' => $quantity
        );

        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], 'id');

            if (!in_array($food_id, $item_array_id)) {
                $next_index = count($_SESSION['cart']);
                $_SESSION['cart'][$next_index] = $item_array;
            } else {
                // Update the quantity if the item is already in the cart
                foreach ($_SESSION['cart'] as &$cart_item) {
                    if ($cart_item['id'] == $food_id) {
                        $cart_item['quantity'] += $quantity;
                    }
                }
            }
        } else {
            $_SESSION['cart'] = array($item_array);
        }
    }
    $_SESSION['total_price'] = 0;
    foreach ($_SESSION['cart'] as $index => $item) {

        $item_total = $item['new_price'] * $item['quantity'];
        $_SESSION['total_price'] += $item_total;
    }
    header('location:' . SITEURL . ''); // Redirect to home page
    exit();
}
