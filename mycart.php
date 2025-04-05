<?php
include('./config/constants.php');
include('user-login-check.php');
include('partials-front/menu.php');
?>

<section class="cart">
    <div>
        <h2 class="text-center">MY CART</h2>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total = 0;

            if (isset($_POST['submit_order'])) {
                // Preserve cart data for `payment.php` after submission
                $_SESSION['order_data'] = [
                    'order_date' => date("Y-m-d h:i:s"),
                    'status' => 'Ordered',
                    'username' => $_SESSION['user']
                ];

                // Redirect to payment page
                echo "<script>window.location.href = 'payment.php';</script>";;
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
                    <input type="submit" name="submit_order" value="Proceed to Payment" class="btn btn-primary">
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