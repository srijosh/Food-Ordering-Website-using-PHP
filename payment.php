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

//Payment API Signature Key Generation
// $tran_uid = rand(1, 100000);
$tran_uid = uniqid('esewa_');

$message = "total_amount=$total,transaction_uuid=$tran_uid,product_code=EPAYTEST";
$s = hash_hmac('sha256', $message, '8gBm/:&EnhH.1/q', true);
$signature = base64_encode($s);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Food Order System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
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
                    <ul>
                        <li>
                            <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                                <input type="hidden" id="amount" name="amount" value="<?php echo $total; ?>" required>
                                <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
                                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total; ?>" required>
                                <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $tran_uid ?>" required>
                                <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                                <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                                <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                                <input type="hidden" id="success_url" name="success_url" value="<?php echo SITEURL; ?>epay-success.php" required>
                                <input type="hidden" id="failure_url" name="failure_url" value="<?php echo SITEURL; ?>payment-failure.php" required>
                                <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                                <input type="hidden" id="signature" name="signature" value="<?php echo $signature ?>" required>
                                <input type="submit" value="Pay With eSewa" class="btn-primary">
                            </form>
                        </li>
                        <li>
                            <form action="cashpay-success.php" method="POST">
                                <!-- <input type="hidden" name="submit_payment" value=1 required> -->
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