<?php
include('partials-front/menu.php');

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Order History.</div>";
    header('location:' . SITEURL . 'login.php');
    exit();
}

// Get the logged in user's username
$username = $_SESSION['user'];

// Retrieve the full name of the user
$sql_user = "SELECT full_name FROM tbl_user WHERE username='$username'";
$res_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($res_user);
$full_name = $row_user['full_name'];

?>

<div class="main">
    <div class="order-history-container">
        <h1>Your Order History</h1>
        <br /><br />

        <table class="order-history-table">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Delivery Status</th>
                <th>Payment Status</th>
            </tr>

            <?php
            // Get all the orders for the logged-in user from the database
            $sql = "SELECT * FROM tbl_order WHERE customer_name='$full_name' ORDER BY id DESC"; // Display the Latest Order at First
            // Execute Query
            $res = mysqli_query($conn, $sql);
            // Count the Rows
            $count = mysqli_num_rows($res);

            $sn = 1; // Create a Serial Number and set its initial value as 1

            if ($count > 0) {
                // Orders Available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get all the order details
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $payment_status = $row['payment_status'];
            ?>

                    <tr>
                        <td data-label="S.N."><?php echo $sn++; ?>. </td>
                        <td data-label="Food"><?php echo $food; ?></td>
                        <td data-label="Price">Rs. <?php echo $price; ?></td>
                        <td data-label="Qty."><?php echo $qty; ?></td>
                        <td data-label="Total">Rs. <?php echo $total; ?></td>
                        <td data-label="Order Date"><?php echo $order_date; ?></td>

                        <td data-label="Delivery Status">
                            <?php
                            // Ordered, On Delivery, Delivered, Cancelled
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td data-label="Payment Status">
                            <?php echo $payment_status; ?>
                        </td>
                    </tr>

            <?php
                }
            } else {
                // Order not Available
                echo "<tr><td colspan='7' class='error'>Orders not available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials-front/footer.php'); ?>