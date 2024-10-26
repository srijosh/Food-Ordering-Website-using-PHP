<?php
include('partials-front/menu.php');
?>

<section class="cart">
    <div>
        <h2 class="text-center">MY CART</h2>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total = 0;

            if (isset($_POST['submit'])) {
                date_default_timezone_set('Asia/Kathmandu');
                // Process the order here
                $order_date = date("Y-m-d h:i:s"); // Order Date //i: A two-digit representation of the minutes (e.g., 05).
                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
                $username = $_SESSION['user'];

                // Retrieve customer details from the database
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
                    $total_item = $new_price * $qty; // total = price x qty 

                    // Save the Order in Database
                    // Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $new_price,
                        qty = $qty,
                        total = $total_item,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // Execute the Query
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

                // Clear the cart after placing the order
                unset($_SESSION['cart']);

                // Remove the total price after placing the order to be shown in the navbar 
                unset($_SESSION['total_price']);

                // Redirect to home page after processing
                header('location:' . SITEURL);
                exit();
            }
        ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['cart'] as $index => $item) {
                        $item_total = $item['new_price'] * $item['quantity'];
                        $total += $item_total;
                    ?>
                        <tr>
                            <td data-label="Serial No."><?php echo $index + 1; ?></td>
                            <td data-label="Item Name"><?php echo $item['title']; ?></td>
                            <td data-label="Item Price">Rs. <?php echo $item['new_price']; ?></td>
                            <td data-label="Quantity">
                                <form action="update-cart.php" method="POST">
                                    <input type="hidden" name="food_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="cart-quantity-input">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                                </form>
                            </td>
                            <td data-label="Total">Rs. <?php echo $item_total; ?></td>
                            <td data-label="Remove">
                                <form action="remove-from-cart.php" method="POST">
                                    <input type="hidden" name="food_id" value="<?php echo $item['id']; ?>">
                                    <input type="submit" name="remove" value="Remove" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <h3>Total: Rs. <?php echo $total; ?></h3>
                <form action="" method="POST">
                    <input type="submit" name="submit" value="Place Order" class="btn btn-primary">
                </form>
            </div>
        <?php
        } else {
            echo "<div class='error'>Your cart is empty.</div>";
        }
        ?>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

<!-- isset($_SESSION['cart']) is like asking, "Does the cart exist?"
!empty($_SESSION['cart']) is like asking, "Does the cart have any items?" -->