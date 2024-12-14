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
                <form action="process-payment.php" method="POST">
                    <label>
                        <input type="radio" name="payment_method" value="Paid" required> Pay Now
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="Cash on Delivery" required> Cash on Delivery
                    </label>
                    <input type="submit" name="submit_payment" value="Confirm Payment" class="btn btn-primary">
                </form>
            </div>
        </section>
    </div>
</body>

</html>