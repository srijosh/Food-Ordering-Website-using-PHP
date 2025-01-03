<?php
include('config/constants.php');
include('user-login-check.php');
// Calculate total price
$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['new_price'] * $item['quantity'];
    }
} else {
    echo "<script>alert('Your cart is empty. Redirecting to home.'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Food Order System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Center the payment section -->
    <div class="payment-container">
        <section class="payment">
            <div class="container">
                <h2 class="text-center">Payment Page</h2>
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <ul>
                        <?php foreach ($_SESSION['cart'] as $item) { ?>
                            <li>
                                <?php echo htmlspecialchars($item['title']); ?>
                                (x<?php echo $item['quantity']; ?>):
                                Rs. <?php echo $item['new_price'] * $item['quantity']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <p><strong>Total Amount:</strong> Rs. <?php echo $total; ?></p>
                </div>
                <div class="payment-list">
                    <ul style="list-style-type: none;">
                        <li>
                            <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                <input value="<?php echo $total; ?>" name="tAmt" type="hidden">
                                <input value="<?php echo $total; ?>" name="amt" type="hidden">
                                <input value="0" name="txAmt" type="hidden">
                                <input value="0" name="psc" type="hidden">
                                <input value="0" name="pdc" type="hidden">
                                <input value="epay_payment" name="scd" type="hidden">
                                <input value="<?php echo rand(1, 1000) ?>" name="pid" type="hidden">
                                <input value="http://localhost/food-order/epay-success.php" type="hidden" name="su">
                                <input value="http://localhost/food-order/payment-failure.php" type="hidden" name="fu">
                                <input type="submit" value="Pay With eSewa" class="btn-primary">
                            </form>
                        </li>
                        <li>
                            <form action="cashpay-success.php" method="POST">

                                <input type="submit" name="submit_payment" value="Cash on Delivery" class="btn-primary">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</body>

</html>